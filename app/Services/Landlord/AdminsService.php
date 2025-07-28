<?php

namespace App\Services\Landlord;

use App\Models\Admin;
use App\Models\Filters\AdminsFilter;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;

class AdminsService extends BaseService
{
    /**
     * Return the filter class for users.
     */
    protected function getFilterClass(): string
    {
        return AdminsFilter::class;
    }

    /**
     * Return the base query for users.
     */
    protected function baseQuery(): Builder
    {
        return Admin::query();
    }
}
