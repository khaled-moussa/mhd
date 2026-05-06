<?php

namespace App\App\Web\Controllers\Shared\Settings;

class SiteEditorController
{
    public function index()
    {
        return view('pages.shared.settings.site-editor.index');
    }

    public function view()
    {
        return view('pages.shared.settings.site-editor.view');
    }
}
