<?php

namespace App\Support\Services\Container;

use App\Domain\Landing\Actions\GetLandingSectionsAction;

class SectionBindingService
{
    /*
    |----------------------------------------------------------------------
    | Boot
    |----------------------------------------------------------------------
    */

    public static function boot(): void
    {
        self::register();
    }

    private static function register(): void
    {
        app()->bind(
            'sections',
            fn() => app(GetLandingSectionsAction::class)->execute()
        );
    }
}
