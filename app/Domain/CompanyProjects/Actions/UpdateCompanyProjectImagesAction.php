<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class UpdateCompanyProjectImagesAction
{
    /*
    |-------------------------------
    | Save Images
    |-------------------------------
    */
    public function execute(CompanyProject $companyProject, array $imagePaths): void
    {
        if ($imagePaths === []) {
            return;
        }

        $companyProject->update(['images' => $imagePaths,]);
    }
}
