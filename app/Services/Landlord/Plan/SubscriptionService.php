<?php

namespace App\Services\Landlord\Plan;

use App\DTOs\SubscriptionPlanDTO;
use App\Models\Landlord\Filters\SubscriptionFilters;
use App\Models\Landlord\Subscription;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SubscriptionService extends BaseService
{
    protected function getFilterClass(): ?string
    {
        return SubscriptionFilters::class;
    }

    protected function baseQuery(): Builder
    {
        return Subscription::query();
    }

    public function create(SubscriptionPlanDTO $subscriptionPlanDTO)
    {
        $subscriptionData = $subscriptionPlanDTO->toArray();
        if (! empty($subscriptionPlanDTO->plan_snapshot)) {
            $subscriptionData['plan_snapshot'] = json_encode($subscriptionPlanDTO->plan_snapshot);
        }

        return $this->getQuery()->create($subscriptionData);
    }

    public function staticsByStatus(): Collection
    {
        return $this->getQuery()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

    }
}
