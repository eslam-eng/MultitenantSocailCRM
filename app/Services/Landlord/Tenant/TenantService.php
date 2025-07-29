<?php

namespace App\Services\Landlord\Tenant;

use App\DTOs\TenantDTO;
use App\Enum\SubscriptionStatusEnum;
use App\Models\Landlord\Tenant;
use App\Models\Landlord\User;
use App\Services\BaseService;
use App\Services\Landlord\Plan\SubscriptionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TenantService extends BaseService
{
    public function __construct(protected readonly SubscriptionService $planSubscriptionService) {}

    protected function getFilterClass(): ?string
    {
        return null;
    }

    protected function baseQuery(): Builder
    {
        return Tenant::query();
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->getQuery($filters)
            ->with(['owner:id,name,tenant_id,email', 'subscription'])
            ->paginate();
    }

    public function statics(): array
    {
        $countsGroupedByStatus = $this->planSubscriptionService->staticsByStatus();

        $trialCount = $countsGroupedByStatus
            ->where('status', SubscriptionStatusEnum::TRIAL)
            ->first()?->total ?? 0;

        $totalActiveAndTrial = $countsGroupedByStatus
            ->whereIn('status', [SubscriptionStatusEnum::ACTIVE, SubscriptionStatusEnum::TRIAL])
            ->sum('total');

        return [
            'trial_count' => $trialCount,
            'active_count' => $totalActiveAndTrial,
            'total_users' => User::query()->count(),
        ];

    }

    public function create(TenantDTO $dto): Tenant
    {
        return $this->getQuery()->create($dto->toArray());
    }

    public function update(int $id, TenantDTO $dto): Model
    {
        $tenant = $this->findById($id);
        $tenant->update($dto->toArray());

        return $tenant;
    }

    public function delete(int $id): bool
    {
        $tenant = $this->findById($id);

        return $tenant->delete();
    }
}
