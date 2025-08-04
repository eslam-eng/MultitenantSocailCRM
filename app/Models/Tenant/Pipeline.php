<?php

namespace App\Models\Tenant;

use App\Enum\ActivationStatusEnum;

class Pipeline extends BaseTenantModel
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => ActivationStatusEnum::class,
    ];

    protected static function booted()
    {
        static::creating(function ($pipeline) {
            $max = static::max('sort_order');
            $pipeline->sort_order = $max ? $max + 1 : 1;
        });
    }
}
