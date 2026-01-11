<?php

namespace App\Providers;

use App\Panel\Resolvers\PanelManager;
use Illuminate\Support\ServiceProvider;
use App\Support\Services\EmailVerificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PanelManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
