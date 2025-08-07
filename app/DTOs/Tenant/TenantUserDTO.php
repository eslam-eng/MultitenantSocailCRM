<?php

namespace App\DTOs\Tenant;

use App\DTOs\Abstract\BaseDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TenantUserDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public int $role_id,
        public ?string $phone = null,
        public ?string $department_id = null,
        public ?string $password = null,
        public ?string $landlord_user_id = null,
        public ?string $email_verified_at = null,
    ) {}

    public static function fromArray(array $data): static
    {
        return new self(
            name: Arr::get($data, 'name'),
            email: Arr::get($data, 'email'),
            role_id: Arr::get($data, 'role_id'),
            phone: Arr::get($data, 'phone'),
            department_id: Arr::get($data, 'department_id'),
            landlord_user_id: Arr::get($data, 'landlord_user_id'),
        );
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            name: $request->name,
            email: $request->email,
            role_id: $request->role_id,
            phone: $request->phone,
            department_id: $request->department_id,
            landlord_user_id: $request->landlord_user_id,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department_id' => $this->department_id,
            'landlord_user_id' => $this->landlord_user_id,
            'email_verified_at' => $this->email_verified_at,
        ];
    }
}
