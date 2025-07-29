<?php

use App\Http\Controllers\Api\Tenant\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'tenant', 'locale'], 'prefix' => '{tenant}'], function () {
    Route::get('customers', [CustomerController::class, 'index']);
    Route::post('customers', [CustomerController::class, 'store']);
});
