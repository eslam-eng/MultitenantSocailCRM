<?php

namespace App\Http\Controllers\Api\Landlord;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SuperAdmin\TenantResource;
use App\Services\Landlord\Tenant\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct(private readonly TenantService $tenantService) {}

    public function index(Request $request)
    {
        $tenants = $this->tenantService->paginate(filters: $request->all());

        return TenantResource::collection($tenants);
    }

    public function statics()
    {
        $statics = $this->tenantService->statics();

        return ApiResponse::success(data: $statics);
    }
}
