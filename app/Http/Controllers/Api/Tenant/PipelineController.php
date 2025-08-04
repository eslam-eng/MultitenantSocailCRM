<?php

namespace App\Http\Controllers\Api\Tenant;

use App\DTOs\PipelineDTO;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MovePipelineRequest;
use App\Http\Requests\Tenant\PipelineRequest;
use App\Http\Resources\Tenant\PipelineResource;
use App\Services\Tenant\PipelineService;
use Illuminate\Http\Request;

class PipelineController extends Controller
{
    public function __construct(protected PipelineService $pipelineService)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->all();

        return PipelineResource::collection($this->pipelineService->getPipelines($filters));
    }

    public function show($id)
    {
        $pipeline = $this->pipelineService->findById($id);

        return ApiResponse::success(data: PipelineResource::make($pipeline));
    }

    public function store(PipelineRequest $request)
    {
        $dto = PipelineDTO::fromRequest($request);
        $this->pipelineService->create($dto);
        return ApiResponse::success(message: 'Pipeline created successfully.');
    }

    public function update(PipelineRequest $request, $pipeline)
    {
        $dto = PipelineDTO::fromRequest($request);
        $this->pipelineService->update(pipeline: $pipeline, dto: $dto);
        return ApiResponse::success(message: 'Pipeline updated successfully.');
    }

    public function destroy($pipeline)
    {
        $this->pipelineService->delete($pipeline);

        return ApiResponse::success(message: 'Pipeline deleted successfully.');
    }

    public function move(MovePipelineRequest $request)
    {
        $this->pipelineService->move(pipelineId: $request->pipeline_id, direction: $request->direction);;

        return ApiResponse::success(message: 'Pipeline sorted successfully.');
    }
}
