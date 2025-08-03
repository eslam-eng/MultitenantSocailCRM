<?php

namespace App\Http\Resources\Tenant\Role;

use App\Enum\PermissionsEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'name' => PermissionsEnum::from($this->name)->getLabel(),
            'value' => $this->name,
        ];
    }
}
