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
        $this->composeSidebar();
        $this->composeUserPanel();
    }

    /**
     * Share sidebar data with app sidebar view.
     */
    protected function composeSidebar(): void
    {
        View::composer(
            'components.navigation.sidebar.app',
            function ($view) {
                $panel   = app(PanelManager::class)->current();
                $sidebar = app(SidebarBuilder::class);

                $view->with([
                    'panel'       => $panel,
                    'primaryMenu' => $sidebar->buildPrimary($panel),
                    'secondaryMenu' => $sidebar->buildSecondary($panel),
                ]);
            }
        );
    }

    /**
     * Share current user panel id.
     */
    protected function composeUserPanel(): void
    {
        View::composer(
            [
                'pages.shared.*',
                'components.dropdown.profile',
            ],
            function ($view) {
                $panelId = app(GetCurrentUserAction::class)
                    ->execute()
                    ->getPanelId();

                $view->with('panel', $panelId);
            }
        );
    }
}
