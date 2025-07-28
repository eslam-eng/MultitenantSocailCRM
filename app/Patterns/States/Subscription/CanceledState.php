<?php

namespace App\Patterns\States\Subscription;

use App\Enum\SubscriptionStatusEnum;
use App\Exceptions\SubscriptionException;

class CanceledState extends SubscriptionState
{
    /**
     * @throws SubscriptionException
     */
    public function activate(): void
    {
        throw new SubscriptionException(__(
            'subscription.cannot_activate_canceled'
        ));
    }

    /**
     * @throws SubscriptionException
     */
    public function cancel(): void
    {
        throw new SubscriptionException(__(
            'subscription.already_canceled'
        ));
    }

    /**
     * @throws SubscriptionException
     */
    public function expire(): void
    {
        throw new SubscriptionException(__(
            'subscription.cannot_expire_canceled'
        ));
    }

    /**
     * @throws SubscriptionException
     */
    public function suspend(): void
    {
        throw new SubscriptionException(__(
            'subscription.cannot_suspend_canceled'
        ));
    }

    /**
     * @throws SubscriptionException
     */
    public function markPastDue(): void
    {
        throw new SubscriptionException(__(
            'subscription.cannot_mark_past_due_canceled'
        ));
    }

    public function getStatus(): SubscriptionStatusEnum
    {
        return SubscriptionStatusEnum::CANCELED;
    }
}
