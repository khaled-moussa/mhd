<?php

namespace App\Providers;

use App\Support\Services\Email\EmailService;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(
        EmailService $emailService
    ): void {
        $emailService->boot();
    }
}
