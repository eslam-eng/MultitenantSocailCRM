<?php

use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\EnsureTenantAccess;
use App\Http\Middleware\ResolveTenantUser;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('api/landlord')
                ->group(base_path('routes/landlord/landlord.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware
            ->group('tenant', [
                EnsureEmailIsVerified::class,
                NeedsTenant::class,
                EnsureTenantAccess::class,
                ResolveTenantUser::class,
            ])
            ->alias([
                'locale' => SetLocale::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
