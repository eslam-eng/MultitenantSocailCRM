<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Api\CountryCodeController;
use App\Http\Controllers\Api\Tenant\CustomerController;
use App\Http\Controllers\Api\Tenant\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'tenant', 'locale']], function () {
    Route::group(['middleware' => 'skipTenantParameter'], function () {
        Route::get('profile', [UserController::class, 'profile']);
        Route::get('country-code', CountryCodeController::class);
        Route::get('customers/statics', [CustomerController::class, 'statics']);
        Route::apiResource('customers', CustomerController::class);
    });
    Route::fallback(function () {
        return ApiResponse::notFound(message: 'Requested Url not found');
    });
})->where(['tenant' => '^(?!landlord$).*']);
// ✅ Handle unknown landlord routes
Route::any('{any}', function () {
    return ApiResponse::notFound(message: 'Requested Url not found');
})->where('any', '.*');
