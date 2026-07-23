<?php

namespace App\Providers;

use App\Contracts\PropertyOwnerRepositoryInterface;
use App\Contracts\PropertyUnitsRepositoryInterface;
use App\Repository\PropertyOwnerRepository;
use App\Repository\PropertyUnitsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Correct way to bind interface to implementation
        $this->app->bind(PropertyOwnerRepositoryInterface::class, PropertyOwnerRepository::class);
        $this->app->bind(PropertyUnitsRepositoryInterface::class, PropertyUnitsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
