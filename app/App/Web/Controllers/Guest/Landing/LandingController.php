<?php

namespace App\App\Web\Controllers\Guest\Landing;

use App\App\Web\Resources\Landing\LandingSectionsResource;
use App\Domain\Landing\Actions\FilterVisibleLandingSectionsAction;
use App\Domain\Landing\Actions\GetCurrentLandingSectionsAction;

class LandingController
{
    public function __invoke()
    {
        $sectionsMerged = app(GetCurrentLandingSectionsAction::class)
            ->execute();

        $visibleSections = app(FilterVisibleLandingSectionsAction::class)
            ->execute(sections: $sectionsMerged);

        $sections = LandingSectionsResource::collection($visibleSections)
            ->resolve();

        return view('pages.guest.landing.index', compact('sections'));
    }
}
