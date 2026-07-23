<?php

namespace App\Repository;

use App\Contracts\PropertyUnitsRepositoryInterface;
use App\GeneralFunctionsTrait;
use App\Models\PropertyUnit;

class PropertyUnitsRepository implements PropertyUnitsRepositoryInterface
{
    use GeneralFunctionsTrait;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function checkPropertyNameExists(string $name): bool
    {
        return PropertyUnit::query()
            ->where('unit_name', $name)
            ->exists();
    }

    public function storePropertyUnit(array $validated): PropertyUnit
    {
        return PropertyUnit::query()->create([
            'unit_name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'slug'=> $this->generateCode(20)
        ]);
    }
}
