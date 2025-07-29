<?php

namespace App\Models\Landlord;

use App\Enum\SubscriptionStatusEnum;
use App\Patterns\States\Subscription\ActiveState;
use App\Patterns\States\Subscription\CanceledState;
use App\Patterns\States\Subscription\ExpiredState;
use App\Patterns\States\Subscription\PendingState;
use App\Patterns\States\Subscription\SubscriptionState;
use App\Patterns\States\Subscription\SuspendedState;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class Subscription extends BaseLandlordModel
{
    protected $fillable = [
        'plan_id',
        'tenant_id',
        'status',
        'starts_at',
        'ends_at',
        'trial_ends_at',
        'auto_renew',
        'plan_snapshot',
    ];

    protected $casts = [
        'status' => SubscriptionStatusEnum::class,
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'canceled_at' => 'datetime',
        'auto_renew' => 'boolean',
        'plan_snapshot' => 'array',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_subscriptions')
            ->withPivot('value', 'usage')
            ->using(FeatureSubscription::class);
    }

    protected function planName(): Attribute
    {
        $locale = app()->getLocale();

        return Attribute::make(
            get: fn () => Arr::get($this->plan_snapshot, 'name.'.$locale, $this->plan_snapshot['name']['en']) ?? null
        );

    }

    public function setState(SubscriptionState $state): void
    {
        $this->state = $state;
    }

    public function getState(): ?SubscriptionState
    {
        if ($this->state === null) {
            $this->initializeState();
        }

        return $this->state;
    }

    protected function initializeState(): void
    {
        $this->state = match ($this->status) {
            SubscriptionStatusEnum::PENDING => new PendingState($this),
            SubscriptionStatusEnum::ACTIVE => new ActiveState($this),
            SubscriptionStatusEnum::CANCELED => new CanceledState($this),
            SubscriptionStatusEnum::EXPIRED => new ExpiredState($this),
            SubscriptionStatusEnum::SUSPENDED => new SuspendedState($this),
            //            SubscriptionStatus::PAST_DUE => new PastDueState($this),
        };
    }

    public function activate(): void
    {
        $this->getState()->activate();
    }

    public function cancel(): void
    {
        $this->getState()->cancel();
    }

    public function expire(): void
    {
        $this->getState()->expire();
    }

    public function suspend(): void
    {
        $this->getState()->suspend();
    }

    public function markPastDue(): void
    {
        $this->getState()->markPastDue();
    }
}
