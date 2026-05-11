<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Emails\Subscribers\UserEmailSubscriber;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
