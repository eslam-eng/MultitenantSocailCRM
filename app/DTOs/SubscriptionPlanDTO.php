<?php

namespace App\DTOs;

use App\DTOS\Abstract\BaseDTO;
use App\Enum\ActivationStatusEnum;
use App\Enum\SubscriptionStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SubscriptionPlanDTO extends BaseDTO
{
    public function __construct(
        public int $plan_id,
        public string $tenant_id,
        public string $starts_at,
        public string $ends_at,
        public bool $auto_renew = ActivationStatusEnum::INACTIVE->value,
        public ?string $status = SubscriptionStatusEnum::ACTIVE->value,
        public ?array $plan_snapshot = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            plan_id: Arr::get($data, 'plan_id'),
            tenant_id: Arr::get($data, 'tenant_id'),
            starts_at: Arr::get($data, 'starts_at'),
            ends_at: Arr::get($data, 'ends_at'),
            auto_renew: Arr::get($data, 'auto_renew'),
            status: Arr::get($data, 'status'),
            plan_snapshot: Arr::get($data, 'plan_snapshot'),

        );
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            plan_id: $request->plan_id,
            tenant_id: $request->tenant_id,
            starts_at: $request->starts_at,
            ends_at: $request->ends_at,
            auto_renew: $request->auto_renew,
            status: $request->status,
            plan_snapshot: $request->plan_snapshot,
        );
    }

    public function toArray(): array
    {
        return [
            'plan_id' => $this->plan_id,
            'tenant_id' => $this->tenant_id,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'auto_renew' => $this->auto_renew,
            'status' => $this->status,
            'plan_snapshot' => $this->plan_snapshot,
        ];
    }
}
