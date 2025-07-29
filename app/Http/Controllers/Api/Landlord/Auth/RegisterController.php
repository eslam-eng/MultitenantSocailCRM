<?php

namespace App\Http\Controllers\Api\Landlord\Auth;

use App\DTOs\UserDTO;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Api\AuthUserResource;
use App\Services\Landlord\Actions\Auth\RegisterService;
use App\Services\Landlord\Actions\Auth\VerificationCodeService;

class RegisterController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function __invoke(RegisterRequest $request, RegisterService $registerService, VerificationCodeService $verificationCodeService)
    {
        try {
            $userDTO = UserDTO::fromRequest($request);

            $user = $registerService->handle(registerDTO: $userDTO);

            $code = $verificationCodeService->sendVerificationCode(
                email: $user->email,
                type: 'email_verification',
                userName: $user->name
            );
            $user->fresh();
            $data = [
                'token' => $user->generateToken(),
                'user' => AuthUserResource::make($user),
                'code' => $code,
            ];

            return ApiResponse::success(data: $data);
        } catch (\Exception $e) {
            dd($e);

            return ApiResponse::error(message: 'there is an error please try again later or contact with support for fast response');
        }
    }
}
