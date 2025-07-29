<?php

namespace App\Http\Resources\Api\SuperAdmin;

use App\Enum\ActivationStatusEnum;
use App\Enum\FeatureGroupEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
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
            'description' => $this->getTranslatedFallback('description'),
            'group' => $this->group,
            'group_text' => FeatureGroupEnum::from($this->group)->getLabel(),
            'is_active' => $this->is_active,
            'is_active_text' => ActivationStatusEnum::from($this->is_active)->getLabel(),
            'value' => $this->whenPivotLoaded('feature_plans', fn () => $this->pivot->value)
                ?? $this->whenPivotLoaded('feature_subscriptions', fn () => $this->pivot->value),
        ];
    }
}
