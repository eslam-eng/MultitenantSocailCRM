<?php

namespace App\Services\Landlord\Actions\Auth;

use App\DTOs\AuthCredentialsDTO;
use App\Models\Landlord\Admin;
use App\Services\Landlord\AdminsService;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

readonly class AdminAuthService
{
    /**
     * Inject UsersService via constructor.
     */
    public function __construct(protected AdminsService $adminsService) {}

    /**
     * Attempt to login with credentials and return user or unauthorized exception.
     *
     * @throws UnauthorizedHttpException
     */
    public function authenticate(AuthCredentialsDTO $credentials): Admin
    {
        $filterKey = preg_match('/^\d+$/', $credentials->identifier) ? 'phone' : 'email';
        $filters = [$filterKey => $credentials->identifier];
        $admin = $this->adminsService->getQuery($filters)->first();
        if (! $admin || ! Hash::check($credentials->password, $admin->password)) {
            throw new UnauthorizedHttpException('', __('auth.failed'));
        }

        // Optionally, you can generate a token here if using API tokens
        return $admin;
    }
}
