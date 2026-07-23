<?php

namespace App\Http\Controllers\Api\V1;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UnitsControllerRequest;
use App\Http\Resources\Api\V1\UnitsControllerResource;
use App\Services\PropertyUnitsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UnitsController extends Controller
{

    protected PropertyUnitsService $service;

    public function __construct(PropertyUnitsService $service)
    {
        $this->service = $service;
    }



    public function oldstoreUnit(UnitsControllerRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $unit = $this->service->storeUnit($validated);

            return response()->json([
                'success' => true,
                'message' => 'Unit created successfully.',
                'data' => new UnitsControllerResource($unit),
            ], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please check the following errors.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create unit.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
