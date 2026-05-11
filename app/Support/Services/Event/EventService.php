<?php

namespace App\Support\Services\Event;

use App\Domain\Emails\Subscribers\UserEmailSubscriber;
use Illuminate\Support\Facades\Event;

class EventService
{
    /*
    |----------------------------------------------------------------------
    | Boot
    |----------------------------------------------------------------------
    */

    public static function boot(): void
    {
        static::registerEvents();
    }

    /*
    |----------------------------------------------------------------------
    | Register Namespaces
    |----------------------------------------------------------------------
    */

    private static function registerEvents(): void
    {
        Event::subscribe(UserEmailSubscriber::class);
    }
}
