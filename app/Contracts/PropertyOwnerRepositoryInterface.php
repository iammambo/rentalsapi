<?php

namespace App\Contracts;

use App\Models\User;

interface PropertyOwnerRepositoryInterface
{
    /**
     * Persist a property owner and its related user record.
     *
     * @param array<string, mixed> $data
     */
    public function storePropertyOwner(array $data): User;
}
