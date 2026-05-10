<?php

namespace App\App\Web\Controllers\Shared\Settings;

use App\Support\Context\SectionContext;

class SiteEditorController
{
    public function index()
    {
        return view('pages.shared.settings.site-editor.index');
    }

    public function view()
    {
        return view('pages.shared.settings.site-editor.view', [
            'sections' => SectionContext::all()
        ]);
    }
}
