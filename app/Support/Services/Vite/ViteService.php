<?php

namespace App\Support\Services\Vite;

use Illuminate\Support\Facades\Vite;

class ViteService
{
    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public static function boot(): void
    {
        self::registerMacros();
    }

    /*
    |--------------------------------------------------------------------------
    | Macros
    |--------------------------------------------------------------------------
    */

    private static function registerMacros(): void
    {
        self::registerAssetsMacros();
        self::registerEntryMacros();
    }

    /*
    |--------------------------------------------------------------------------
    | Asset Macros
    |--------------------------------------------------------------------------
    */

    private static function registerAssetsMacros(): void
    {
        Vite::macro(
            'image',
            fn(string $asset) =>
            Vite::asset("resources/assets/images/{$asset}")
        );

        Vite::macro(
            'video',
            fn(string $asset) =>
            Vite::asset("resources/assets/videos/{$asset}")
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Entry Point Macros
    |--------------------------------------------------------------------------
    */

    private static function registerEntryMacros(): void
    {
        Vite::macro(
            'style',
            fn(string $path) =>
            Vite::withEntryPoints("resources/css/pages/{$path}")
        );

        Vite::macro(
            'script',
            fn(string $path) =>
            Vite::withEntryPoints("resources/js/pages/{$path}")
        );
    }
}
