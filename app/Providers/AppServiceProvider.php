<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Support\Services\AppServiceBootstrap;

class AppServiceProvider extends ServiceProvider
{
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