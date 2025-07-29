<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends BaseTenantModel
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'template_type',
        'content',
        'header_type',
        'header_content',
        'footer_content',
        'status',
    ];

    public function buttons(): HasMany
    {
        return $this->hasMany(TemplateButton::class)->orderBy('sort_order');
    }

    public function parameters(): HasMany
    {
        return $this->hasMany(TemplateVariable::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }
}
