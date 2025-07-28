<?php

use App\Http\Controllers\Api\Landlord\Auth\AuthController;
use App\Http\Controllers\Api\Landlord\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Landlord\Auth\GoogleAuthController;
use App\Http\Controllers\Api\Landlord\Auth\RegisterController;
use App\Http\Controllers\Api\Landlord\Auth\SendVerificationCodeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {

    Route::middleware('throttle:login')->group(function () {
        Route::post('login', AuthController::class);
        Route::post('register', RegisterController::class);
    });

    Route::get('google', [GoogleAuthController::class, 'redirectToProvider']);
    Route::post('google/callback', [GoogleAuthController::class, 'authenticate']);
});
Route::prefix('auth')->middleware(['throttle:verification_code'])->group(function () {
    Route::post('send-verification-code', SendVerificationCodeController::class);
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword']);
});

