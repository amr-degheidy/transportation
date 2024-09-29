<?php

namespace App\Providers;

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Services\Auth\AdminAuthService;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;

class BindServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(AuthController::class)
            ->needs(AuthServiceInterface::class)
            ->give(function () {
               return new AdminAuthService();
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
