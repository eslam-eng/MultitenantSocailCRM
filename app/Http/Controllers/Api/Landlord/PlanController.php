<?php

namespace App\Http\Controllers\Api\Landlord;

use App\DTOs\PlanDTO;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Http\Resources\Api\SuperAdmin\PlanResource;
use App\Services\Landlord\Plan\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(protected PlanService $planService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = array_filter([
            'is_active' => $request->query('is_active', true),
            'monthly_only' => $request->query('monthly_only'),
            'annual_only' => $request->query('annual_only'),
            'lifetime_only' => $request->query('lifetime_only'),
        ]);

        $withRelations = ['limitFeatures', 'addonFeatures'];

        $plans = $this->planService->paginate(filters: $filters, withRelation: $withRelations);

        return PlanResource::collection($plans);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $planDTO = PlanDTO::fromRequest($request);
        $plan = $this->planService->create(planDTO: $planDTO);

        return ApiResponse::success(message: __('app.plan_created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $withRelations = ['limitFeatures', 'addonFeatures'];
        $plan = $this->planService->findById(id: $id, withRelation: $withRelations);

        return ApiResponse::success(data: PlanResource::make($plan));
    }

    public function statics()
    {
        $statics = $this->planService->statics();
        // overwrite avg price value to be rounded
        $statics['avg_price'] = round($statics['avg_price'], 2);

        return ApiResponse::success(data: $statics);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, string $id)
    {
        $planDTO = PlanDTO::fromRequest($request);
        $plan = $this->planService->update(planDTO: $planDTO, plan: $id);

        return ApiResponse::success(message: __('app.plan_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->planService->delete($id);

        return ApiResponse::success(message: 'Plan deleted successfully');
    }
}
