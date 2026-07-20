<?php

namespace App\Contracts;

use App\Http\Requests\Api\V1\StorePropertyOwnerRequest;
use App\Models\User;

interface PropertyOwnerRepositoryInterface
{
    public function storePropertyOwner(StorePropertyOwnerRequest $request): User;
}

