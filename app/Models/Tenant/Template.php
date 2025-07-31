<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Template extends BaseTenantModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'category',
        'template_type',
        'whatsapp_number',
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
