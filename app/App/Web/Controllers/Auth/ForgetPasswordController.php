<?php

namespace App\App\Web\Controllers\Auth;

use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    public function __invoke()
    {
        return view('pages.auth.forgot-password');
    }
}
