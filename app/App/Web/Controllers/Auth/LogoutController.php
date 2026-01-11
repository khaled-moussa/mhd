<?php

namespace App\App\Web\Controllers\Auth;

use App\Domain\Auth\Actions\LogoutCurrentUserAction;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        app(LogoutCurrentUserAction::class)->execute();
        return redirect()->route('auth.login');
    }
}
