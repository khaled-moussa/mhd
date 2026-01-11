<?php

namespace App\App\Web\Controllers\Auth;

use App\Http\Controllers\Controller;

class TwoFactorController extends Controller
{
    public function __invoke()
    {
        return view('pages.auth.two-factor-auth');
    }
}
