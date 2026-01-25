<?php

namespace App\Panel\Panels;

use App\Domain\CompanyServices\Models\CompanyService;
use App\Domain\ServiceRequests\Models\ServiceRequest;
use App\Domain\Users\Models\User;
use App\Navigation\Sidebar\SidebarItem;
use App\Panel\Contracts\PanelContract;

class AdminPanel implements PanelContract
{
    public function id(): string
    {
        return 'admin';
    }

    public function layout(): string
    {
        return 'layouts.admin';
    }

    public function dashboardRoute(): string
    {
        return 'admin.dashboard';
    }

    public function primarySidebarItems(): array
    {
        return [
            new SidebarItem(
                label: 'Dashboard',
                routeName: 'admin.dashboard',
                icon: 'fi-tr-chart-tree-map',
            ),

            new SidebarItem(
                label: 'Services',
                routeName: 'admin.company-services.index',
                icon: 'fi-tc-person-carry-box',
            ),

            new SidebarItem(
                label: 'Projects',
                routeName: 'admin.company-projects.index',
                icon: 'fi fi-tr-construction-location',
            ),
        ];
    }

    public function secondarySidebarItems(): array
    {
        return [
            new SidebarItem(
                label: 'Settings',
                routeName: 'admin.settings.profile',
                activePatterns: [
                    'admin.settings.*',
                ],
                icon: 'fi fi-tc-settings'
            ),
        ];
    }
}
