<?php

namespace App\Http\Controllers\Api\Landlord;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeLocalRequest;
use App\Http\Resources\Landlord\AuthUserResource;

class AdminController extends Controller
{
    public function profile()
    {
        $user = auth()->guard('landlord')->user();

        return ApiResponse::success(data: AuthUserResource::make($user));
    }

    public function updateLocale(ChangeLocalRequest $request)
    {
        $user = auth()->guard('landlord')->user();
        $user->locale = $request->input('locale');
        $user->save();

        return ApiResponse::success(message: 'Locale updated successfully.');
    }
}
