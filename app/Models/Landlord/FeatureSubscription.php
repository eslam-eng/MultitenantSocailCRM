<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FeatureSubscription extends Pivot
{
    protected $table = 'feature_subscriptions';
}
