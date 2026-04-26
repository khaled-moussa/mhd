<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Panel\Resolvers\PanelManager;
use App\Support\Services\AppServiceBootstrap;

class AppServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------------------------------------
    | Register Services
    |--------------------------------------------------------------------------
    */

    public function register(): void
    {
        $this->app->singleton(PanelManager::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Boot Services
    |--------------------------------------------------------------------------
    */

    public function boot(): void
    {
        AppServiceBootstrap::boot();
    }
}