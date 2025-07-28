<?php

namespace App\Patterns\States\Subscription;

use App\Enum\SubscriptionStatusEnum;
use App\Exceptions\SubscriptionException;

class PastDueState extends SubscriptionState
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
        $this->subscription->setState(new ExpiredState($this->subscription));
        $this->subscription->status = SubscriptionStatusEnum::EXPIRED;
        $this->subscription->save();
    }

    public function suspend(): void
    {
        $this->subscription->setState(new SuspendedState($this->subscription));
        $this->subscription->status = SubscriptionStatusEnum::SUSPENDED;
        $this->subscription->save();
    }

    public function markPastDue(): void
    {
        throw new SubscriptionException(__(
            'subscription.already_past_due'
        ));
    }

    public function getStatus(): SubscriptionStatusEnum
    {
        return SubscriptionStatusEnum::PAST_DUE;
    }
}
