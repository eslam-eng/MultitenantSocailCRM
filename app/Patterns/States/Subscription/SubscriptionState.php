<?php

namespace App\Patterns\States\Subscription;

use App\Enum\SubscriptionStatusEnum;
use App\Models\Landlord\Subscription;

abstract class SubscriptionState
{
    public function __construct(protected Subscription $subscription) {}

    abstract public function activate(): void;

    abstract public function cancel(): void;

    abstract public function expire(): void;

    abstract public function suspend(): void;

    abstract public function markPastDue(): void;

    abstract public function getStatus(): SubscriptionStatusEnum;
}
