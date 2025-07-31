<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeLocalRequest;
use App\Http\Resources\tenant\AuthUserResource;

class UserController extends Controller
{
    public function updateLocale(ChangeLocalRequest $request)
    {
        $user = auth()->user();
        $user->locale = $request->input('locale');
        $user->save();

        return ApiResponse::success(message: 'Locale updated successfully.');
    }

    public function profile()
    {
        $user = auth()->user();

        return ApiResponse::success(data: AuthUserResource::make($user));
    }
}
