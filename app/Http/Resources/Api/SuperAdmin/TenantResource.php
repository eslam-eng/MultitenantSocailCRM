<?php

namespace App\Http\Resources\Api\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subscriptionRelationLoaded = $this->relationLoaded('subscription');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'users_count' => $this->users_count,

            'email' => $this->when(
                $this->relationLoaded('owner'),
                fn () => $this->owner?->email,
            ),

            'package' => $this->when($subscriptionRelationLoaded, fn () => $this->subscription->plan_name),
            'package_price' => $this->when($subscriptionRelationLoaded, fn () => Arr::get($this->subscription->plan_snapshot, 'price')),
            'is_active' => $this->is_active->value,
            'is_active_text' => $this->is_active->getLabel(),
            'subscription_status' => $this->when($subscriptionRelationLoaded, fn () => $this->subscription->status->value),
            'subscription_status_text' => $this->when($subscriptionRelationLoaded, fn () => $this->subscription->status->getLabel()),
        ];
    }
}
