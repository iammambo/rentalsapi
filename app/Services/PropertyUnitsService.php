<?php

namespace App\Services;

use App\Contracts\PropertyUnitsRepositoryInterface;
use App\Models\PropertyUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PropertyUnitsService
{
    protected PropertyUnitsRepositoryInterface $repository;

    public function __construct(PropertyUnitsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new property unit inside a database transaction.
     *
     * @param array<string, mixed> $data
     */
    public function storeUnit(array $data): PropertyUnit
    {
        DB::beginTransaction();

        try {
            if ($this->repository->checkPropertyNameExists($data['name'])) {
                throw ValidationException::withMessages([
                    'name' => "You have already added this {$data['name']} property unit.",
                ]);
            }

            $unit = $this->repository->storePropertyUnit($data);

            DB::commit();

            return $unit;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
