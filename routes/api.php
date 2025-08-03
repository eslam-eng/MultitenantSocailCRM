<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Api\Tenant\CustomerController;
use App\Http\Controllers\Api\Tenant\RoleController;
use App\Http\Controllers\Api\Tenant\TemplateController;
use App\Http\Controllers\Api\Tenant\UserController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'tenant', 'locale']], function () {
    Route::group(['middleware' => 'skipTenantParameter'], function () {
        Route::get('profile', [UserController::class, 'profile']);
        Route::put('locale', [UserController::class, 'updateLocale']);

        Route::get('customers/statics', [CustomerController::class, 'statics']);
        Route::apiResource('customers', CustomerController::class);

        Route::apiResource('templates', TemplateController::class);

        Route::post('upload', UploadFileController::class);
        Route::get('permissions', [RoleController::class, 'permissionsList']);
        Route::apiResource('roles', RoleController::class);

    });

    Route::fallback(function () {
        return ApiResponse::notFound(message: 'Requested Url not found');
    });
})->where(['tenant' => '^(?!landlord$).*']);
// // ✅ Handle unknown landlord routes
// Route::any('{any}', function () {
//    return ApiResponse::notFound(message: 'Requested Url not found');
// })->where('any', '.*');
