<?php

namespace App\App\Web\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Context\AuthContext;

class LogoutController extends Controller
{
    public function __invoke()
    {
        AuthContext::logout();
        
        return redirect()->route('auth.login');
    }
}
