<?php

namespace App\Patterns\States\Subscription;

use App\Enum\SubscriptionStatusEnum;
use App\Exceptions\SubscriptionException;

class PendingState extends SubscriptionState
{
    public function activate(): void
    {
        $this->subscription->setState(new ActiveState($this->subscription));
        $this->subscription->status = SubscriptionStatusEnum::ACTIVE;
        $this->subscription->save();
    }

    public function cancel(): void
    {
        $this->subscription->setState(new CanceledState($this->subscription));
        $this->subscription->status = SubscriptionStatusEnum::CANCELED;
        $this->subscription->save();
    }

    public function expire(): void
    {
        throw new SubscriptionException(__('subscription.cannot_expire_pending'));
    }

    public function suspend(): void
    {
        throw new SubscriptionException(__('subscription.cannot_suspend_pending'));
    }

    public function markPastDue(): void
    {
        throw new SubscriptionException(__('subscription.cannot_mark_past_due_pending'));
    }

    public function getStatus(): SubscriptionStatusEnum
    {
        return SubscriptionStatusEnum::PENDING;
    }
}
