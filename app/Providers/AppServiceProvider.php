<?php

namespace App\Providers;

use App\Contracts\PropertyOwnerRepositoryInterface;
use App\Repository\PropertyOwnerRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
