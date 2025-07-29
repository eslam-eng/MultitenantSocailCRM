<?php

namespace Database\Factories\Landlord;

use App\Enum\ActivationStatusEnum;
use App\Enum\SubscriptionDurationEnum;
use App\Models\Landlord\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'ar' => fake()->slug(),
                'en' => fake()->slug(),
            ],
            'description' => [
                'ar' => fake()->sentence(10),
                'en' => fake()->sentence(10),
            ],
            'price' => fake()->numberBetween(30, 50),
            'billing_cycle' => fake()->randomElement(SubscriptionDurationEnum::values()),
            'is_active' => fake()->randomElement(ActivationStatusEnum::values()),
            'trial_days' => 14,  // Common trial period of 14 days
            'sort_order' => fake()->numberBetween(1, 100),
            'currency' => 'USD',  // Default currency
            'refund_days' => fake()->numberBetween(0, 30),  // Common refund period up to 30 days
        ];
    }
}
