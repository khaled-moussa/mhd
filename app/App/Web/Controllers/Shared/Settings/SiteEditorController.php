<?php

namespace App\App\Web\Controllers\Shared\Settings;

use App\App\Web\Resources\Landing\LandingSectionsResource;
use App\Domain\Landing\Actions\GetCurrentLandingSectionsAction;

class SiteEditorController
{
    public function index()
    {
        return view('pages.shared.settings.site-editor.index');
    }

    public function view()
    {
        $sectionsMerged = app(abstract: GetCurrentLandingSectionsAction::class)->execute();
        $sections = LandingSectionsResource::collection($sectionsMerged)->resolve();

        return view('pages.shared.settings.site-editor.view', compact('sections'));
    }
}
