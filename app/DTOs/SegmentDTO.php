<?php

namespace App\DTOs;

use App\DTOs\Abstract\BaseDTO;
use App\Enum\ActivationStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SegmentDTO extends BaseDTO
{
    public function __construct(public string $name, public string $description, public bool $is_active = ActivationStatusEnum::ACTIVE->value) {}

    public static function fromArray(array $data): static
    {
        return new self(
            name: Arr::get($data, 'name'),
            description: Arr::get($data, 'description'),
            is_active: Arr::get($data, 'is_active', ActivationStatusEnum::ACTIVE->value)
        );
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            name: $request->name,
            description: $request->description,
            is_active: $request->is_active
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active ?? ActivationStatusEnum::ACTIVE->value,
        ];
    }
}
