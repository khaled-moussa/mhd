<?php

namespace App\App\Web\Controllers\Panels\Admin\Contacts;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __invoke()
    {
        return view('pages.panels.admin.contacts.index');
    }
}
