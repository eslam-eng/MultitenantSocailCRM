<?php

namespace App\DTOs;

use App\DTOs\Abstract\BaseDTO;
use App\Enum\ActivationStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoleDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $guard_name = 'web',
        public array $permissions = [],
        public bool $is_active = ActivationStatusEnum::ACTIVE->value,
    ) {}

    public static function fromRequest(Request $request): static
    {
        return new self(
            name: $request->name,
            permissions: $request->get('permissions', []),
            is_active: $request->get('is_active'),
        );
    }

    /**
     * @return $this
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: Arr::get($data, 'name'),
            permissions: Arr::get($data, 'permissions'),
            is_active: Arr::get($data, 'is_active',ActivationStatusEnum::ACTIVE->value),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'is_active' => $this->is_active,
        ];
    }

}
