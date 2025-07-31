<?php

namespace App\Models\Tenant;

class TempFile extends BaseTenantModel
{
    protected $fillable = [
        'file_id',
        'path',
        'original_name',
        'mime_type',
    ];
}
