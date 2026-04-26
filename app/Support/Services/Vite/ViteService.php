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
            fn (string $asset) =>
                Vite::asset("resources/assets/images/{$asset}")
        );

        Vite::macro(
            'video',
            fn (string $asset) =>
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
            fn (string $path) =>
                Vite::withEntryPoints("resources/css/pages/{$path}")
        );

        Vite::macro(
            'script',
            fn (string $path) =>
                Vite::withEntryPoints("resources/js/pages/{$path}")
        );

        /*
        |-----------------------------
        | Panel: Admin
        |-----------------------------
        */
        Vite::macro(
            'adminStyle',
            fn (string $path) =>
                Vite::withEntryPoints("resources/css/pages/panels/admin/{$path}")
        );

        Vite::macro(
            'adminScript',
            fn (string $path) =>
                Vite::withEntryPoints("resources/js/pages/panels/admin/{$path}")
        );

        /*
        |-----------------------------
        | Panel: User
        |-----------------------------
        */
        Vite::macro(
            'userStyle',
            fn (string $path) =>
                Vite::withEntryPoints("resources/css/pages/panels/user/{$path}")
        );

        Vite::macro(
            'userScript',
            fn (string $path) =>
                Vite::withEntryPoints("resources/js/pages/panels/user/{$path}")
        );
    }
}