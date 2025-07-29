<?php

namespace App\Services\Landlord\Plan;

use App\DTOs\PlanDTO;
use App\Models\Landlord\Filters\PlanFilters;
use App\Models\Landlord\Plan;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PlanService extends BaseService
{
    protected function getFilterClass(): ?string
    {
        return PlanFilters::class;
    }

    protected function baseQuery(): Builder
    {
        return Plan::query();
    }

    public function getFreePlan()
    {
        return $this->getQuery()->trial()->first();
    }

    public function paginate(array $filters = [], array $withRelation = []): LengthAwarePaginator
    {
        return $this->getQuery(filters: $filters, withRelation: $withRelation)->paginate();
    }

    /**
     * @throws \Throwable
     */
    public function create(PlanDTO $planDTO)
    {
        return DB::connection('landlord')->transaction(function () use ($planDTO) {
            $plan = $this->getQuery()->create($planDTO->toArray());
            $allFeaturesToAttach = $this->prepareFeaturesAndLimits($planDTO);
            $plan->features()->attach($allFeaturesToAttach);

            return $plan;
        });
    }

    /**
     * @throws \Throwable
     */
    public function update(PlanDTO $planDTO, int $plan)
    {
        $plan = $this->findById($plan);

        return DB::transaction(function () use ($planDTO, $plan) {
            $plan->update($planDTO->toArrayExcept(['features', 'limits']));
            $allFeaturesToAttach = $this->prepareFeaturesAndLimits($planDTO);
            $plan->features()->sync($allFeaturesToAttach);

            return $plan;
        });
    }

    /**
     * Prepare combined features and limits array for sync/attach
     */
    private function prepareFeaturesAndLimits(PlanDTO $planDTO): array
    {
        $features = collect($planDTO->features ?? [])->mapWithKeys(function ($value, $id) {
            return [$id => ['value' => $value]];
        })->all();

        $limits = collect($planDTO->limits ?? [])->mapWithKeys(function ($value, $id) {
            return [$id => ['value' => $value]];
        })->all();

        return array_merge($features, $limits);
    }

    public function delete(int $plan_id): ?bool
    {
        $plan = $this->findById($plan_id);

        return $plan->delete();
    }
}
