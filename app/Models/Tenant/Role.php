<?php

namespace App\Models\Tenant;

use App\Enum\ActivationStatusEnum;
use App\Patterns\States\Subscription\ActiveState;
use App\Traits\Filterable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Role extends \Spatie\Permission\Models\Role
{
    use UsesTenantConnection, Filterable;
    protected $fillable = ['name', 'guard_name', 'is_active'];

    protected $table = 'roles';

    protected $casts = [
        'is_active' => ActivationStatusEnum::class,
    ];
}
