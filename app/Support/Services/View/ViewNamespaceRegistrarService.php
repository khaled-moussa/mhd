<?php

namespace App\Support\Services\View;

use Illuminate\Support\Facades\View;

class ViewNamespaceRegistrarService
{
    public function boot(): void
    {
        $this->registerPanelNamespaces();
    }

    protected function registerPanelNamespaces(): void
    {
        $this->registerNamespaces([
            // Admin panel
            'admin'          => 'pages/panels/admin',
            'admin_livewire' => 'livewire/panels/admin',

            // User panel
            'user'           => 'pages/panels/user',
            'user_livewire'  => 'livewire/panels/user',
        ]);
    }

    protected function registerNamespaces(array $namespaces): void
    {
        foreach ($namespaces as $namespace => $path) {
            View::addNamespace($namespace, resource_path("views/{$path}"));
        }
    }
}
