<?php

namespace App\App\Web\Controllers\Guest\Projects;

class ProjectController
{
    public function __invoke()
    {
        return view('pages.guest.projects.index');
    }
}
