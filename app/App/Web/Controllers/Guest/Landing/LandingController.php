<?php

namespace App\App\Web\Controllers\Guest\Landing;

use App\Support\Context\SectionContext;

class LandingController
{
    public function __invoke()
    {
        return view('pages.landing.home.index', [
            'sections' => SectionContext::toMapping()
        ]);
    }
}
