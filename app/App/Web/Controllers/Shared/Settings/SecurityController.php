<?php

namespace App\App\Web\Controllers\Shared\Settings;

use App\Http\Controllers\Controller;

class SecurityController extends Controller
{
    public function __invoke()
    {
        return view('pages.shared.settings.security.index');
    }
}
