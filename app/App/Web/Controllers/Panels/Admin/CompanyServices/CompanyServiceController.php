<?php

namespace App\App\Web\Controllers\Panels\Admin\CompanyServices;

use App\Http\Controllers\Controller;

class CompanyServiceController extends Controller
{
    public function __invoke()
    {
        return view('pages.panels.admin.company-services.index');
    }
}
