<?php

use App\Helpers\ApiResponse;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\EnsureTenantAccess;
use App\Http\Middleware\ResolveTenantUser;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SkipTenantParameter;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::prefix('api/landlord')
                ->group(base_path('routes/landlord/landlord.php'));

            Route::prefix('api/{tenant}')
                ->group(base_path('routes/api.php'));

        },
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
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
                'skipTenantParameter' => SkipTenantParameter::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                $message = $request->hasHeader('Authorization')
                    ? 'Invalid or expired token.'
                    : 'No authentication token provided.';

                return ApiResponse::unauthorized(message: $message);
            }
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::notFound(message: 'Customer not found');
            }
        });
        // Server Error Exception (500)
        $exceptions->render(function (Exception $e, Request $request) {
            if ($request->is('api/*') && ! config('app.debug')) {
                return ApiResponse::serverError(message: 'there is an error please try again later or contact with support for fast response');
            }
        });

    })->create();
