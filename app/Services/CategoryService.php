<?php

namespace App\Services;

use App\DTOs\SegmentDTO;
use App\Models\Campaign;
use App\Models\Segment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService extends BaseService
{
    protected function getFilterClass(): ?string
    {
        return null;
    }

    protected function baseQuery(): Builder
    {
        return Segment::query();
    }

    /**
     * @throws \Throwable
     */
    public function create(SegmentDTO $dto): Campaign
    {
        return $this->getQuery()->create($dto->toArray());

    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->getQuery($filters)->paginate();
    }

    public function update(int $id, SegmentDTO $dto): Model
    {
        $segment = $this->findById($id);
        $segment->update($dto->toArray());

        return $segment;
    }

    public function delete(int $id): bool
    {
        $segment = $this->findById($id);

        return $segment->delete();
    }
}
