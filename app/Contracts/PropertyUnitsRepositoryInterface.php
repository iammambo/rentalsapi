<?php

namespace App\Contracts;

use App\Models\PropertyUnit;

interface PropertyUnitsRepositoryInterface
{
    public function checkPropertyNameExists(string $name): bool;

    public function storePropertyUnit(array $validated): PropertyUnit;
}
