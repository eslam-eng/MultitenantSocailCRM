<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AuthUserResource;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return ApiResponse::success(data: AuthUserResource::make($user));
    }
}
