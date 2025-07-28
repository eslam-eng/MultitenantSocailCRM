<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'locale' => $this->locale,
            'tenant_id' => $this->tenant_id,
            'tenant_name' => $this->currentTenant?->slug,
            'is_verified' => isset($this->email_verified_at),
            'is_super_admin' => false,
        ];
    }
}
