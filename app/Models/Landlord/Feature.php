<?php

namespace App\Models\Landlord;

use App\Traits\HasTranslatedFallback;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Feature extends BaseLandlordModel
{
    use HasTranslatedFallback,HasTranslations,SoftDeletes;

    protected $fillable = ['slug', 'name', 'description', 'group', 'is_active'];

    public $translatable = ['name', 'description'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'feature_plan')
            ->withPivot('value')
            ->using(FeaturePlan::class);
    }

    public function planSubscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'feature_subscriptions')
            ->withPivot('value', 'usage')
            ->using(FeatureSubscription::class);
    }

    public static function booted()
    {
        static::creating(function ($feature) {
            $feature->slug = Str::slug($feature->getTranslation('name', 'en'));
        });
    }
}
