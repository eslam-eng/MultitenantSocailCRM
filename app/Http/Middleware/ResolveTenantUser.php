<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use App\Models\Landlord\Tenant;
use App\Models\Tenant\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenantUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only proceed if a tenant is set and a user is authenticated && auth user is instance for Landlord user

        if (Tenant::current() && auth()->check()) {
            $landlordUser = auth()->user(); // Landlord user

            $tenant = Tenant::current();

            // Switch to tenant database (handled by SwitchTenantDatabaseTask)
            $tenant->makeCurrent();

            // Find tenant-specific user by email
            $tenantUser = User::where('email', $landlordUser->email)->first();

            if ($tenantUser) {
                // Set tenant user as the authenticated user
                Auth::setUser($tenantUser);
            } else {
                return ApiResponse::unauthorized(message: 'Tenant user not authorized to access ');
            }
        }

        return $next($request);
    }
}
