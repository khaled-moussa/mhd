<?php

namespace App\Support\Services\View;

class ViewService
{
    public function boot(): void
    {
        app(EnumViewService::class)->boot();
        app(PanelViewService::class)->boot();
        app(UserViewService::class)->boot();
        app(ViewNamespaceRegistrarService::class)->boot();
    }
}
