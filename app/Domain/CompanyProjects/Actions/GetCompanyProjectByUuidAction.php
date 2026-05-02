<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCompanyProjectByUuidAction
{
    /*
    |-------------------------------
    | Get Company Project by UUID
    |-------------------------------
    */
    public function execute(string $uuid): CompanyProject
    {
        return CompanyProject::where('uuid', $uuid)->firstOr(function () {
            throw new ModelNotFoundException('CompanyProject not found.');
        });
    }
}