<?php

namespace App\App\Web\Controllers\Panels\Admin\CompanyProjects;

use App\Http\Controllers\Controller;

class CompanyProjectController extends Controller
{
    public function __invoke()
    {
        return view('pages.panels.admin.company-projects.index');
    }
}
