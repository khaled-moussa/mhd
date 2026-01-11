<?php

namespace App\Panel\Panels;

use App\Domain\ServiceRequests\Models\ServiceRequest;
use App\Navigation\Sidebar\SidebarItem;
use App\Panel\Contracts\PanelContract;

class UserPanel implements PanelContract
{
    public function id(): string
    {
        return 'user';
    }

    public function layout(): string
    {
        return 'layouts.user';
    }

    public function dashboardRoute(): string
    {
        return 'user.dashboard';
    }

    public function primarySidebarItems(): array
    {
        return [
            new SidebarItem(
                label: 'Dashboard',
                routeName: 'user.dashboard',
                icon: 'fi-tr-chart-tree-map'
            ),
        ];
    }

    public function secondarySidebarItems(): array
    {
        return [
            new SidebarItem(
                label: 'Settings',
                routeName: 'user.settings.profile',
                activePatterns: [
                    'user.settings.*',
                ],
                icon: 'fi fi-tc-settings'
            ),
        ];
    }
}
