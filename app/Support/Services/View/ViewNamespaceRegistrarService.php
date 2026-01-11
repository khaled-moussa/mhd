<?php

namespace App\Support\Services\View;

use Illuminate\Support\Facades\View;

class ViewNamespaceRegistrarService
{
    /**
     * Register custom view namespaces.
     */
    public function boot(): void
    {
        // Admin panel views
        View::addNamespace('admin', resource_path('views/pages/panels/admin'));
        View::addNamespace('admin_livewire', resource_path('views/livewire/panels/admin'));

        // User panel views
        View::addNamespace('user', resource_path('views/pages/panels/user'));
        View::addNamespace('user_livewire', resource_path('views/livewire/panels/user'));
    }
}
