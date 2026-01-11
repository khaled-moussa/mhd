<?php

namespace App\Providers;

use App\Support\Services\Blade\BladeService;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(
        BladeService $bladeService,
    ): void {
        $bladeService->boot();
    }
}
