<?php

namespace App\Models\Tenant;

use App\Enum\ActivationStatusEnum;

class Department extends BaseTenantModel
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => ActivationStatusEnum::class,
    ];
}
