<?php

namespace App\Providers;

use App\Support\Services\View\ViewService;
use App\Support\Services\Vite\ViteService;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(
        ViewService $viewService,
        ViteService $viteService,
    ): void {
        $viteService->boot();
        $viewService->boot();
    }
}
