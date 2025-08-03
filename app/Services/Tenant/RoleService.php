<?php

namespace App\Services\Tenant;

use App\DTOs\RoleDTO;
use App\Models\Tenant\Role;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class RoleService extends BaseService
{
    protected function getFilterClass(): ?string
    {
        return null;
    }

    protected function baseQuery(): Builder
    {
        return Role::query();
    }


    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->getQuery($filters)
            ->withCount('permissions')
            ->paginate();
    }

    public function roles(array $filters = [])
    {
        return $this->getQuery($filters)
            ->withCount('permissions')
            ->get();
    }

    public function create(RoleDTO $roleDTO): Builder|Model|Role
    {
        return $role = $this->getQuery()->create($roleDTO->toArray());

        return DB::connection('tenant')->transaction(function () use ($roleDTO) {
            $role = $this->getQuery()->create($roleDTO->toArray());
            $role->syncPermissions($roleDTO->permissions);
        });
    }


    /**
     * @throws \Throwable
     */
    public function update(Role|int $role, RoleDTO $roleDTO)
    {
        return DB::connection('tenant')->transaction(function () use ($role, $roleDTO) {
            if (is_int($role)) {
                $role = parent::findById($role);
            }
            $role->update($roleDTO->toArray());
            $role->syncPermissions($roleDTO->permissions);
        });
    }

    public function delete(Role|int $role): ?bool
    {
        if (is_int($role) || is_string($role)) {
            $role = parent::findById($role);
        }

        return $role->delete();
    }


    public function getRoleBySlug(string $slug): Model|Builder|null
    {
        return $this->getQuery()->where('name', $slug)->first();
    }
}
