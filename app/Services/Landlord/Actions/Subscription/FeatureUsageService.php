<?php

namespace App\Services\Landlord\Actions\Subscription;

use App\Enum\SubscriptionStatusEnum;
use App\Exceptions\SubscriptionException;
use App\Models\Landlord\FeatureSubscription;

class FeatureUsageService
{
    /**
     * Attempt to increment feature usage across multiple subscriptions.
     *
     * @throws \Throwable
     */
    public function consumeIfAvailable(string $tenantId, string $slug, int $amount = 1): bool
    {
        // Get all feature subscriptions for this feature and tenant
        $features = FeatureSubscription::query()
            ->where('slug', $slug)
            ->whereHas('subscription', fn ($q) => $q->where('tenant_id', $tenantId)->whereNotIn('status', SubscriptionStatusEnum::inactive()))
            ->orderByRaw('`value` - `usage` DESC') // escape reserved keywords
            ->lockForUpdate()
            ->get();

        $remaining = $amount;

        foreach ($features as $feature) {
            $available = $feature->value - $feature->usage;
            if ($available <= 0) {
                continue;
            }

            $toConsume = min($available, $remaining);
            $feature->increment('usage', $toConsume);
            $remaining -= $toConsume;

            if ($remaining <= 0) {
                return true; // success
            }
        }

        throw new SubscriptionException("You have reached the limit for {$features->first()?->name}. Please upgrade your subscription.");
    }

    public function releaseFeatureUsage(string $tenantId, string $slug, int $amount = 1): void
    {
        $features = FeatureSubscription::query()
            ->where('slug', $slug)
            ->whereHas('subscription', fn ($q) => $q->where('tenant_id', $tenantId)->whereNotIn('status', SubscriptionStatusEnum::inactive()))
            ->orderByDesc('usage') // release from the most used first
            ->lockForUpdate()
            ->get();

        $remaining = $amount;

        foreach ($features as $feature) {
            if ($feature->usage <= 0) {
                continue;
            }

            $toRelease = min($feature->usage, $remaining);
            $feature->decrement('usage', $toRelease);
            $remaining -= $toRelease;

            if ($remaining <= 0) {
                return;
            }
        }

        // Optional: if you want to throw when no usage was found to release
        // throw new \Exception("Nothing to release for feature: $slug");
    }
}
