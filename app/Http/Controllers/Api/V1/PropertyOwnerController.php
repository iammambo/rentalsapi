<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePropertyOwnerRequest;
use App\Http\Resources\Api\V1\PropertyOwnerResource;
use App\Services\PropertyOwnerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PropertyOwnerController extends Controller
{
    protected PropertyOwnerService $service;

    public function __construct(PropertyOwnerService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created property owner.
     *
     * @param StorePropertyOwnerRequest $request
     * @return JsonResponse
     */
    public function storePropertyOwner(StorePropertyOwnerRequest $request): JsonResponse
    {
        try {
            $user = $this->service->registerPropertyOwner($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Property owner registered successfully.',
                'data' => new PropertyOwnerResource($user)
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register property owner.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
