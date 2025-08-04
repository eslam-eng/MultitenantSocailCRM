<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Api\CountryCodeController;
use App\Http\Controllers\Api\Landlord\AdminAuthController;
use App\Http\Controllers\Api\Landlord\AdminController;
use App\Http\Controllers\Api\Landlord\Auth\AuthController;
use App\Http\Controllers\Api\Landlord\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Landlord\Auth\GoogleAuthController;
use App\Http\Controllers\Api\Landlord\Auth\RegisterController;
use App\Http\Controllers\Api\Landlord\Auth\SendVerificationCodeController;
use App\Http\Controllers\Api\Landlord\FeatureController;
use App\Http\Controllers\Api\Landlord\PlanController;
use App\Http\Controllers\Api\Landlord\TenantController;
use App\Http\Controllers\Api\Landlord\UserController;
use App\Http\Controllers\Api\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('locales', LocaleController::class);
Route::get('country-code', CountryCodeController::class);

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

// for tenant and shared tables
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('change-password', [UserController::class, 'changePassword']);
});

Route::group(['middleware' => 'auth:landlord'], function () {
    Route::get('tenants/statics', [TenantController::class, 'statics']);
    Route::apiResource('tenants', TenantController::class);
    Route::get('plans/statics', [PlanController::class, 'statics']);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('features', FeatureController::class)->only(['index']);
    Route::get('admin/profile', [AdminController::class, 'profile']);
    Route::put('locale', [AdminController::class, 'updateLocale']);
});
// ✅ Handle unknown landlord routes
Route::any('{any}', function () {
    return ApiResponse::notFound(message: 'Requested Url not found');
})->where('any', '.*');
