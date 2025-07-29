<?php

namespace App\Http\Controllers\Api\Landlord\Auth;

use App\Enum\AvailableSocialProvidersEnum;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AuthUserResource;
use App\Services\Landlord\Actions\Auth\SocialAuthService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function __construct(protected readonly SocialAuthService $socialAuthService) {}

    public function redirectToProvider(string $provider = 'google')
    {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return ApiResponse::success(data: ['url' => $url]);
    }

    public function authenticate(Request $request)
    {
        try {

            if ($request->get('access_token') == null || $request->get('access_token') == '') {
                return ApiResponse::badRequest(message: 'Access token is missing');
            }

            $user = $this->socialAuthService->handle(provider_name: AvailableSocialProvidersEnum::GOOGLE->value, access_token: $request->access_token);

            $currentTenant = $user->tenant;
            $currentTenant->makeCurrent();

            // Create tenant-specific token
            $token = $user->generateToken(name: 'multi-tenant-access', abilities: ['tenant:'.$currentTenant->id]);

            $data = [
                'token' => $token,
                'user' => AuthUserResource::make($user),
                'tenant' => [
                    'name' => $currentTenant->name,
                    'slug' => $currentTenant->slug,
                ],
            ];

            return ApiResponse::success(data: $data);

        } catch (\Exception $e) {
            return ApiResponse::error(message: 'there is an error please try again later or contact with support for fast response');
        }
    }
}
