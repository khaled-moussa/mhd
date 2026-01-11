<?php

namespace App\Navigation\Sidebar;

use App\Panel\Contracts\PanelContract;

class SidebarBuilder
{
    public function buildPrimary(PanelContract $panel): array
    {
        return collect($panel->primarySidebarItems())
            ->filter(fn($item) => $item->isVisible($panel))
            ->values()
            ->all();
    }

    public function buildSecondary(PanelContract $panel): array
    {
        return collect($panel->secondarySidebarItems())
            ->filter(fn($item) => $item->isVisible($panel))
            ->values()
            ->all();
    }
}
