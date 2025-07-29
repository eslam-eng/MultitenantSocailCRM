<?php

namespace App\Providers;

use App\Helpers\ApiResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(1000),
                Limit::perMinute(3)->by($request->input('email'))->response(function (Request $request, array $headers) {
                    $retryAfter = $headers['Retry-After'] ?? 60;

                    return ApiResponse::error(message: "Too many attempts. Try again in {$retryAfter} seconds.", code: 429);
                }),
            ];
        });

        RateLimiter::for('verification_code', function (Request $request) {
            $email = (string) $request->input('email');
            $ip = $request->ip();

            // Combine both as unique keys
            $key = $email ?: $ip;

            return Limit::perMinute(1)->by($key)
                ->response(function (Request $request, array $headers) {
                    $retryAfter = $headers['Retry-After'] ?? 60;

                    return ApiResponse::error(
                        message: "Too many password reset attempts. Try again in {$retryAfter} seconds.",
                        code: 429
                    );
                });
        });
    }
}
