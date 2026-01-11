<?php

namespace App\App\Web\Controllers\Shared\Settings;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __invoke()
    {
        return view('pages.shared.settings.profile.index');
    }
}
