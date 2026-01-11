<?php

namespace App\App\Web\Controllers\Shared\Settings;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function __invoke()
    {
        return view('pages.shared.settings.notifications.index');
    }
}
