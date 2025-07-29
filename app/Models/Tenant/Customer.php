<?php

namespace App\Models\Tenant;

use App\Enum\CustomerSourceEnum;
use App\Enum\CustomerStatusEnum;

class Customer extends BaseTenantModel
{
    protected $fillable = [
        'name', 'country_code', 'phone', 'email', 'notes',
        'source', 'address', 'country', 'city', 'zipcode', 'status', 'tags',
    ];

    protected $casts = [
        'source' => CustomerSourceEnum::class,
        'status' => CustomerStatusEnum::class,
        'tags' => 'array',
    ];
}
