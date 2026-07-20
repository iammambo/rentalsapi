<?php

namespace App\Services;

use App\Contracts\PropertyOwnerRepositoryInterface;
use App\Http\Requests\Api\V1\StorePropertyOwnerRequest;
use App\Models\User;

class PropertyOwnerService
{
    protected PropertyOwnerRepositoryInterface $repository;

    public function __construct(PropertyOwnerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function registerPropertyOwner(StorePropertyOwnerRequest $request): User
    {
        return $this->repository->storePropertyOwner($request);
    }
}
