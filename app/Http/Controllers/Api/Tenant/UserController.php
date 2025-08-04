<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeLocalRequest;

class UserController extends Controller
{
    public function updateLocale(ChangeLocalRequest $request)
    {
        $user = auth()->user();
        $user->locale = $request->input('locale');
        $user->save();

        return ApiResponse::success(message: 'Locale updated successfully.');
    }
}
