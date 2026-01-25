<?php

namespace App\Support\Services\View;

use App\App\Web\Resources\Landing\LandingSectionsResource;
use App\Domain\Landing\Actions\BuildLandingHeadersAction;
use App\Domain\Landing\Actions\FilterVisibleLandingSectionsAction;
use App\Domain\Landing\Actions\GetCurrentLandingSectionsAction;
use Illuminate\Support\Facades\View;

class LandingSectionViewService
{
    public function boot(): void
    {
        View::composer([
            'pages.guest.landing.index',
            'pages.guest.projects.index',
            'components.navigation.navbar.guest',
        ], function ($view) {


            static $sections = null;
            static $headers  = null;



            if ($sections === null) {

                $sectionsMerged = app(GetCurrentLandingSectionsAction::class)
                    ->execute();

                $visibleSections = app(FilterVisibleLandingSectionsAction::class)
                    ->execute(sections: $sectionsMerged);

                $sections = LandingSectionsResource::collection($visibleSections)
                    ->resolve();

                $headers = app(BuildLandingHeadersAction::class)
                    ->execute(sections: $sections, excluded: ['footer']);
            }

            if (view()->shared('isPreview')) {
                $view->with([
                    'headers'  => $headers,
                ]);
                return;
            }

            $view->with([
                'sections' => $sections,
                'headers'  => $headers,
            ]);
        });

        View::composer(
            'components.navigation.navbar.guest',
            fn($view) => $view->with('currentRequest', request()->is('/'))
        );
    }
}
