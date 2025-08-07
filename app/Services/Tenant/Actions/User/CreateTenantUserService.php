<?php

namespace App\Services\Tenant\Actions\User;

use App\DTOs\Tenant\TenantUserDTO;
use App\Models\Tenant\Filters\UsersFilter;
use App\Models\Tenant\Role;
use App\Models\Tenant\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateTenantUserService extends BaseService
{
    /**
     * Return the filter class for users.
     */
    protected function getFilterClass(): string
    {
        return UsersFilter::class;
    }

    /**
     * Return the base query for users.
     */
    protected function baseQuery(): Builder
    {
        return User::query();
    }

    public function handle(TenantUserDTO $tenantUserDTO)
    {
        // get auth user from tenant to get tenant object and create user for tenant
        $random_password = $this->generateRandomPassword($tenantUserDTO->email);

        $user = auth()->user();
        // get current landlord for auth user
        $currentLandlordForAuthUser = \App\Models\Landlord\User::query()
            ->where('id', $user->landlord_user_id)
            ->first();

        // check if tenant has availability to create user
        $tenant = $currentLandlordForAuthUser->tenant;

        $this->startTransaction();

        $tenant->consumeFeature(slug: 'max-users');

        // create landlord user;
        $landlordUser = $this->createLandlordUser($tenantUserDTO, $random_password);

        $tenant->users()->attach($landlordUser->id);

        // set email verfied at
        $tenantUserDTO->email_verified_at = now();

        $tenantUser = $this->baseQuery()->create($tenantUserDTO->toArray());

        $role = Role::query()->find($tenantUserDTO->role_id);

        $tenantUser->assignRole($role->name);

        $this->commitTransaction();

        $this->sendCredentialsEmail($tenantUser, $random_password);

        return $tenantUser;
    }

    private function generateRandomPassword($emailOrName): string
    {
        $base = strtolower(preg_replace('/[^a-z]/i', '', $emailOrName));
        $base = substr($base, 0, 5); // Take first 5 characters max
        $random_number = substr(preg_replace('/\D/', '', Str::uuid()), 0, 5);

        return $base.$random_number;
    }

    private function createLandlordUser(TenantUserDTO $dto, $password)
    {
        $user = auth()->user();
        $landlordUser = \App\Models\Landlord\User::find($user->landlord_user_id);

        return \App\Models\Landlord\User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'email_verified_at' => now(),
            'tenant_id' => $landlordUser->tenant->id,
            'password' => bcrypt($password),
        ]);
    }

    private function sendCredentialsEmail(User $user, string $random_password)
    {
        // Send email
        //            Mail::to($user->email)->queue(new UserCredentialsMail(
        //                user: $user,
        //                password: $random_password,
        //                loginUrl: config('app.frontend_login_url'), //todo get it from config and env files for react project
        //            ));
    }

    private function startTransaction(): void
    {
        DB::connection('landlord')->beginTransaction();
        DB::connection('tenant')->beginTransaction();
    }

    private function commitTransaction(): void
    {
        DB::connection('tenant')->commit();
        DB::connection('landlord')->commit();
    }
}
