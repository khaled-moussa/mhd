<?php

namespace App\Support\Services\Container;

class AppBindingService
{
    /*
    |----------------------------------------------------------------------
    | Boot
    |----------------------------------------------------------------------
    */
    
    public static function boot(): void
    {
        SectionBindingService::boot();
    }
}
