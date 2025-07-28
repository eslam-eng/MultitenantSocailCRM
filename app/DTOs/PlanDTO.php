<?php

namespace App\DTOs;

use App\DTOs\Abstract\BaseDTO;
use App\Enum\SubscriptionDurationEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PlanDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public float $price,
        public string $currency_code,
        public string $billing_cycle = SubscriptionDurationEnum::MONTHLY->value,
        public ?string $description = null,
        public bool $is_active = true,
        public int $trial_days = 0,
        public ?int $refund_days = null,
        public ?array $features = [],
        public ?array $limits = []
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            name: Arr::get($data, 'name'),
            price: Arr::get($data, 'price'),
            currency_code: Arr::get($data, 'currency_code'),
            billing_cycle: Arr::get($data, 'billing_cycle'),
            description: Arr::get($data, 'description'),
            is_active: Arr::get($data, 'is_active', true),
            trial_days: Arr::get($data, 'trial_days', 0),
            refund_days: Arr::get($data, 'refund_days'),
            features: Arr::get($data, 'features', []),
            limits: Arr::get($data, 'limits', []),
        );
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            name: $request->name,
            price: $request->price,
            currency_code: $request->currency_code,
            billing_cycle: $request->billing_cycle,
            description: $request->description,
            is_active: $request->is_active,
            trial_days: $request->trial_days,
            refund_days: $request->refund_days,
            features: $request->features,
            limits: $request->limits,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'currency_code' => $this->currency_code,
            'billing_cycle' => $this->billing_cycle,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'trial_days' => $this->trial_days,
            'refund_days' => $this->refund_days,
            'features' => $this->features,
            'limits' => $this->limits,
        ];
    }
}
