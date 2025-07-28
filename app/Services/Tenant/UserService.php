<?php

namespace App\Services\Tenant;

use App\DTOs\UserDTO;
use App\Models\Tenant\Filters\UsersFilter;
use App\Models\Tenant\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;

class UserService extends BaseService
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

    public function create(UserDTO $userDTO)
    {
        return $this->getQuery()->create($userDTO->toArray());
    }
}
