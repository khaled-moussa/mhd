<?php

namespace App\Support\Services;

use App\Support\Services\Container\AppBindingService;
use App\Support\Services\Email\EmailService;
use App\Support\Services\Event\EventService;
use App\Support\Services\Panel\PanelService;
use App\Support\Services\View\ViewService;
use App\Support\Services\Vite\ViteService;

class AppServiceBootstrap
{
    public static function boot(): void
    {
        AppBindingService::boot();
        EmailService::boot();
        EventService::boot();
        ViewService::boot();
        ViteService::boot();
        PanelService::boot();
    }
}
