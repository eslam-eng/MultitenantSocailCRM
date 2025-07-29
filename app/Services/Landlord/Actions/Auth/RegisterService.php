<?php

namespace App\Services\Landlord\Actions\Auth;

use App\DTOs\SubscriptionPlanDTO;
use App\DTOs\TenantDTO;
use App\DTOs\UserDTO;
use App\Models\Landlord\Plan;
use App\Models\Landlord\Subscription;
use App\Models\Landlord\Tenant;
use App\Models\Landlord\User;
use App\Services\Landlord\Plan\PlanService;
use App\Services\Landlord\Plan\SubscriptionService;
use App\Services\Landlord\Tenant\TenantService;
use App\Services\Landlord\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterService
{
    private ?Tenant $createdTenant = null;

    /**
     * Inject UsersService via constructor.
     */
    public function __construct(
        protected UserService $userService,
        protected \App\Services\Tenant\UserService $tenantUserService,
        protected TenantService $tenantService,
        protected PlanService $planService,
        protected SubscriptionService $planSubscriptionService
    ) {}

    /**
     * @throws \Throwable
     */
    public function handle(UserDTO $registerDTO): User
    {

        try {
            return DB::connection('landlord')->transaction(function () use ($registerDTO) {
                return $this->registerUserWithTenant($registerDTO);
            });
        } catch (\Throwable $e) {
            // If tenant was created, drop its database
            if ($this->createdTenant && $this->createdTenant->database) {
                $this->dropTenantDatabase($this->createdTenant->database);
            }
            throw $e;
        }
    }

    private function registerUserWithTenant(UserDTO $registerDTO)
    {
        $tenant = $this->createTenantFromDTO($registerDTO);
        $this->createdTenant = $tenant; // Track for cleanup
        // create landlord user
        $user = $this->createUser($registerDTO, $tenant);
        $this->setupFreeTrial($tenant);

        return $user->fresh();
    }

    private function createTenantFromDTO(UserDTO $registerDTO): Tenant
    {
        $tenantDTO = new TenantDTO(
            name: $registerDTO->organization_name,
            slug: Str::slug($registerDTO->organization_name)
        );

        return $this->tenantService->create($tenantDTO);
    }

    private function createUser(UserDTO $registerDTO, Tenant $tenant): User
    {
        $registerDTO->tenant_id = $tenant->id;

        $landlordUser = $this->userService->create($registerDTO);
        $this->tenantUserService->create($registerDTO);
        $tenant->users()->attach($landlordUser->id, ['is_owner' => true]);
        $tenant->forgetCurrent();

        return $landlordUser;
    }

    private function setupFreeTrial(Tenant $tenant): void
    {
        $plan = $this->planService->getFreePlan();
        $subscription = $this->createTrialSubscription($tenant, $plan);
        $this->attachPlanFeatures($subscription, $plan);
    }

    private function createTrialSubscription(Tenant $tenant, Plan $plan): Subscription
    {
        $trialEndsAt = now()->addDays($plan->trial_days);

        $planSnapshot = $plan->only($plan->getFillable());

        $planSnapshot['name'] = $plan->getTranslations('name');

        $subscriptionPlanDTO = new SubscriptionPlanDTO(
            plan_id: $plan->id,
            tenant_id: $tenant->id,
            starts_at: now(),
            ends_at: $trialEndsAt,
            plan_snapshot: $planSnapshot,
        );

        return $this->planSubscriptionService->create($subscriptionPlanDTO);
    }

    private function attachPlanFeatures(Subscription $subscription, Plan $plan): void
    {
        if (collect($plan->features)->isEmpty()) {
            return;
        }

        // Snapshot features to feature_plan_subscription
        $featuresToAttach = [];
        foreach ($plan->features as $feature) {
            $featuresToAttach[] = [
                'subscription_id' => $subscription->id,
                'feature_id' => $feature->id,
                'slug' => $feature->slug,
                'name' => json_encode($feature->getTranslations('name')),
                'value' => $feature->pivot->value, // value from feature_plan pivot
                'usage' => 0,
            ];
        }
        $subscription->features()->sync($featuresToAttach);
    }

    // Drop the tenant database if needed
    private function dropTenantDatabase(string $databaseName): void
    {
        DB::statement("DROP DATABASE IF EXISTS `$databaseName`");
    }
}
