<?php

namespace App\Support\Services\Panel;

use Illuminate\Support\Facades\View;

class PanelService
{
    /*
    |----------------------------------------------------------------------
    | Boot
    |----------------------------------------------------------------------
    */

    public static function boot(): void
    {
        static::registerNamespaces();
    }

    /*
    |----------------------------------------------------------------------
    | Register Namespaces
    |----------------------------------------------------------------------
    */

    private static function registerNamespaces(): void
    {
        foreach (static::namespaces() as $namespace => $path) {
            View::addNamespace(
                $namespace,
                resource_path("views/{$path}")
            );
        }
    }

    /*
    |----------------------------------------------------------------------
    | Namespace Map
    |----------------------------------------------------------------------
    */

    private static function namespaces(): array
    {
        return [
            // Admin panel
            'admin'          => 'pages/panels/admin',
            'admin_livewire' => 'livewire/panels/admin',

            // User panel
            'user'           => 'pages/panels/user',
            'user_livewire'  => 'livewire/panels/user',
        ];
    }
}