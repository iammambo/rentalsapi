<?php

namespace App\Services;

use App\Contracts\PropertyOwnerRepositoryInterface;
use App\Models\User;

class PropertyOwnerService
{
    protected PropertyOwnerRepositoryInterface $repository;

    public function __construct(PropertyOwnerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function registerPropertyOwner(array $data): User
    {
        return $this->repository->storePropertyOwner($data);
    }
}
