<?php

namespace App\Support\Services\View;

use App\Domain\Users\Actions\GetCurrentUserAction;
use App\Navigation\Sidebar\SidebarBuilder;
use App\Panel\Resolvers\PanelManager;
use Illuminate\Support\Facades\View;

class PanelViewService
{
    public function boot(): void
    {
        View::composer(
            'components.navigation.sidebar.app',
            function ($view) {
                $panel   = app(PanelManager::class)->current();
                $builder = app(SidebarBuilder::class);

                $view->with([
                    'panel'                 => $panel,
                    'primarySidebarItems'   => $builder->buildPrimary($panel),
                    'secondarySidebarItems' => $builder->buildSecondary($panel),
                ]);
            }
        );

        View::composer(
            [
                'pages.shared.*',
                'components.dropdown.profile'
            ],
            function ($view) {
                $user = app(GetCurrentUserAction::class)->execute();

                $view->with([
                    'panel' => $user->getPanelId(),
                ]);
            }
        );
    }
}
