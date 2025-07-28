<?php

namespace App\Services\Landlord;

use App\DTOs\FeatureDTO;
use App\Models\Feature;
use App\Models\Filters\FeaturesFilter;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class FeatureService extends BaseService
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->getQuery(filters: $filters)->paginate($perPage);
    }

    public function create(FeatureDTO $dto): Feature
    {
        return $this->getQuery()->create($dto->toArray());
    }

    public function update(int $id, FeatureDTO $dto): Model
    {
        $feature = $this->findById($id);
        $feature->update($dto->toArray());

        return $feature;
    }

    public function delete(int $id): bool
    {
        $feature = $this->findById($id);
        if ($feature) {
            return $feature->delete();
        }

        return false;
    }

    protected function getFilterClass(): ?string
    {
        return FeaturesFilter::class;
    }

    protected function baseQuery(): Builder
    {
        return Feature::query();
    }
}
