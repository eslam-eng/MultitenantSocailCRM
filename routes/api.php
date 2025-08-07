<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Api\Tenant\CategoryController;
use App\Http\Controllers\Api\Tenant\CustomerController;
use App\Http\Controllers\Api\Tenant\DepartmentController;
use App\Http\Controllers\Api\Tenant\GroupController;
use App\Http\Controllers\Api\Tenant\RoleController;
use App\Http\Controllers\Api\Tenant\TemplateController;
use App\Http\Controllers\Api\Tenant\UserController;
use App\Http\Controllers\Api\Tenant\WorkflowController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'tenant', 'locale']], function () {
    Route::group(['middleware' => 'skipTenantParameter'], function () {

        Route::put('locale', [UserController::class, 'updateLocale']);
        Route::get('customers/statics', [CustomerController::class, 'statics']);
        Route::apiResource('customers', CustomerController::class);

        Route::apiResource('templates', TemplateController::class);

        Route::post('upload', UploadFileController::class);
        Route::get('permissions', [RoleController::class, 'permissionsList']);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('groups', GroupController::class);
        Route::apiResource('departments', DepartmentController::class);
        Route::post('pipelines/move', [WorkflowController::class, 'move']);
        Route::apiResource('pipelines', WorkflowController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('users', UserController::class);
    });

    Route::fallback(function () {
        return ApiResponse::notFound(message: 'Requested Url not found');
    });
})->where(['tenant' => '^(?!landlord$).*']);
// // ✅ Handle unknown landlord routes
// Route::any('{any}', function () {
//    return ApiResponse::notFound(message: 'Requested Url not found');
// })->where('any', '.*');
