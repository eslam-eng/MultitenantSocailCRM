<?php

namespace App\Services\Tenant;

use App\DTOs\CustomerDTO;
use App\Enum\CustomerStatusEnum;
use App\Models\Customer;
use App\Models\Filters\CustomersFilter;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CustomerService extends BaseService
{
    protected function getFilterClass(): ?string
    {
        return CustomersFilter::class;
    }

    protected function baseQuery(): Builder
    {
        return Customer::query();
    }

    public function create(CustomerDTO $customerDTO): Customer
    {
        return $this->getQuery()->create($customerDTO->toArray());
    }

    public function paginate(array $filters = [], $limit = 15): LengthAwarePaginator
    {
        return $this->getQuery($filters)->paginate($limit);
    }

    public function statics()
    {
        $allStatuses = CustomerStatusEnum::cases();
        $counts = DB::table('customers')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');
        $normalized = collect($allStatuses)->mapWithKeys(fn ($status) => [
            $status->getLabel() => $counts->get($status->value, 0),
        ]);
        $total = $counts->sum();

        return [
            'total' => $total,
            'statuses' => $normalized,
        ];
    }

    public function update(int $id, CustomerDTO $customerDTO): Model
    {
        $customer = $this->findById($id);
        $customer->update($customerDTO->toArray());

        return $customer->fresh();
    }

    public function delete(int $id): bool
    {
        $customer = $this->findById($id);

        return $customer->delete();
    }
}
