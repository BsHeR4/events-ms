<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\EventService;
use App\Services\EventTypeService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\EventServiceInterface;
use App\Services\Interfaces\EventTypeServiceInterface;
use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\ReservationServiceInterface;
use App\Services\LocationService;
use App\Services\ReservationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(LocationServiceInterface::class, LocationService::class);
        $this->app->bind(EventTypeServiceInterface::class, EventTypeService::class);
        $this->app->bind(EventServiceInterface::class, EventService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
