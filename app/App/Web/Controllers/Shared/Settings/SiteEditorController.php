<?php

namespace App\App\Web\Controllers\Shared\Settings;

use App\App\Web\Resources\Landing\LandingSectionsResource;
use App\Domain\Landing\Actions\GetCurrentLandingSectionsAction;
use Illuminate\Support\Facades\View;

class SiteEditorController
{
    public function index()
    {
        return view('pages.shared.settings.site-editor.index');
    }

    public function view()
    {
        View::share('isPreview', true);

        $sectionsMerged = app(GetCurrentLandingSectionsAction::class)->execute();
        $sections = LandingSectionsResource::collection($sectionsMerged)->resolve();

        return view('pages.shared.settings.site-editor.view', [
            'sections' => $sections,
            'isPreview' => true,
        ]);
    }
}
