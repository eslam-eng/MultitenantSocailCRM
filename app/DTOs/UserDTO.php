<?php

namespace App\DTOs;

use App\DTOs\Abstract\BaseDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $organization_name,
        public string $email,
        public ?string $password = null,
        public ?string $phone = null,
        public ?string $tenant_id = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            name: Arr::get($data, 'name'),
            organization_name: Arr::get($data, 'organization_name'),
            email: Arr::get($data, 'email'),
            password: Arr::get($data, 'password'),
            phone: Arr::get($data, 'phone'),
            tenant_id: Arr::get($data, 'tenant_id'),
        );
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            name: $request->name,
            organization_name: $request->organization_name,
            email: $request->email,
            password: $request->password,
            phone: $request->phone,
            tenant_id: $request->tenant_id,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'organization_name' => $this->organization_name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'tenant_id' => $this->tenant_id,
        ];
    }
}
