<?php

namespace App\Http\Middleware;

use App\Models\Landlord\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $currentTenant = Tenant::current();

        if (!$user || !$currentTenant) {
            return response()->json(['error' => 'No tenant context'], 403);
        }

        // Check if the user's token scope matches the current tenant
        $token = $user->currentAccessToken();
        if (!$token->can('tenant:' . $currentTenant->id)) {
            return response()->json(['error' => 'Unauthorized tenant access'], 403);
        }

        return $next($request);
    }
}
