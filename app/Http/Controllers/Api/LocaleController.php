<?php

namespace App\Http\Controllers\Api;

use App\Enum\SupportedLocalesEnum;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function __invoke()
    {
        $locales = collect(SupportedLocalesEnum::cases())->map(function ($locale) {
            return [
                'name' => $locale->name,
                'value' => $locale->value,
            ];
        })->toArray();

        return ApiResponse::success(data: $locales);
    }
}
