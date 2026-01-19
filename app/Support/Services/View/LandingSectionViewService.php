<?php

namespace App\Support\Services\View;

use App\App\Web\Resources\Landing\LandingSectionsResource;
use Illuminate\Support\Facades\View;
use App\Domain\Landing\Actions\FilterVisibleLandingSectionsAction;
use App\Domain\Landing\Actions\GetCurrentLandingSectionsAction;

class LandingSectionViewService
{
    public function boot(): void
    {
        View::composer('pages.guest.*', function ($view) {
            $sectionsMerged = app(GetCurrentLandingSectionsAction::class)
                ->execute();

            $visibleSections = app(FilterVisibleLandingSectionsAction::class)
                ->execute(sections: $sectionsMerged);

            $sections = LandingSectionsResource::collection($visibleSections)
                ->resolve();

            $view->with('sections', $sections);
        });

        View::composer('components.navigation.navbar.guest', function ($view) {
            $view->with('currentRequest', request()->is('/'));
        });
    }
}
