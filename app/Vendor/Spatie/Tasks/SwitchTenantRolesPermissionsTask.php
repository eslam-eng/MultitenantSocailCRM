<?php

namespace App\Vendor\Spatie\Tasks;

use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;
use Spatie\Permission\PermissionRegistrar;

class SwitchTenantRolesPermissionsTask implements SwitchTenantTask
{
    protected mixed $originalRoleModel;

    protected mixed $originalPermissionModel;

    public function __construct()
    {
        $this->originalRoleModel = config('permission.models.role');
        $this->originalPermissionModel = config('permission.models.permission');
    }

    public function makeCurrent(Tenant|IsTenant $tenant): void
    {
        $this->clearPermissionCache();
        $this->setTenantPermissionConfig($tenant);
        $this->refreshPermissionRegistrar();
    }

    public function forgetCurrent(): void
    {
        $this->clearPermissionCache();
        $this->resetPermissionConfig();
        $this->refreshPermissionRegistrar();
    }

    /**
     * Clear the permission cache
     */
    protected function clearPermissionCache(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Set tenant-specific permission configuration
     */
    protected function setTenantPermissionConfig(Tenant $tenant): void
    {
        // Set tenant-specific cache key
        $cacheKey = "spatie.permission.cache.tenant.{$tenant->id}";
        config(['permission.cache.key' => $cacheKey]);

        // Set tenant-specific models
        config([
            'permission.models.role' => 'App\\Models\\Tenant\\Role',
            'permission.models.permission' => 'App\\Models\\Tenant\\Permission',
        ]);

        // Set tenant-specific table names if needed
        config([
            'permission.table_names.roles' => 'roles',
            'permission.table_names.permissions' => 'permissions',
            'permission.table_names.model_has_permissions' => 'model_has_permissions',
            'permission.table_names.model_has_roles' => 'model_has_roles',
            'permission.table_names.role_has_permissions' => 'role_has_permissions',
        ]);
    }

    /**
     * Reset permission configuration to default
     */
    protected function resetPermissionConfig(): void
    {
        config([
            'permission.cache.key' => 'spatie.permission.cache',
            'permission.models.role' => $this->originalRoleModel,
            'permission.models.permission' => $this->originalPermissionModel,
        ]);
    }

    /**
     * Refresh the permission registrar
     */
    protected function refreshPermissionRegistrar(): void
    {
        app()->forgetInstance(PermissionRegistrar::class);
        app(PermissionRegistrar::class)->registerPermissions();
    }
}
