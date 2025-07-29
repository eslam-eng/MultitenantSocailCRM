<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Api\Landlord\AdminAuthController;
use App\Http\Controllers\Api\Landlord\Auth\AuthController;
use App\Http\Controllers\Api\Landlord\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Landlord\Auth\GoogleAuthController;
use App\Http\Controllers\Api\Landlord\Auth\RegisterController;
use App\Http\Controllers\Api\Landlord\Auth\SendVerificationCodeController;
use App\Http\Controllers\Api\Landlord\FeatureController;
use App\Http\Controllers\Api\Landlord\PlanController;
use App\Http\Controllers\Api\Landlord\TenantController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {

    Route::middleware('throttle:login')->group(function () {
        Route::post('login', AuthController::class);
        Route::post('admin/login', AdminAuthController::class);
        Route::post('register', RegisterController::class);
    });

    Route::get('google', [GoogleAuthController::class, 'redirectToProvider']);
    Route::post('google/callback', [GoogleAuthController::class, 'authenticate']);

});

Route::prefix('auth')->group(function () {
    Route::post('send-verification-code', SendVerificationCodeController::class);
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword']);
});

Route::group(['middleware' => 'auth:landlord'], function () {
    Route::get('tenants/statics', [TenantController::class, 'statics']);
    Route::apiResource('tenants', TenantController::class);
    Route::get('plans/statics', [PlanController::class, 'statics']);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('features', FeatureController::class)->only(['index']);
});
// ✅ Handle unknown landlord routes
Route::any('{any}', function () {
    return ApiResponse::notFound(message: 'Requested Url not found');
})->where('any', '.*');
