<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'country_code' => $this->country_code,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status->getLabel(),
            'source' => $this->source->getLabel(),
            'country' => $this->country,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'notes' => $this->notes,
            'tags' => $this->tags,
        ];
    }
}
