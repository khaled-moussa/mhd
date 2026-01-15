<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class SaveCompanyProjectImagesAction
{
    /**
     * Save images for a specific company project.
     */
    public function execute(CompanyProject $companyProject, array $imagePaths): void
    {
        if (!$companyProject || empty($imagePaths)) {
            return;
        }

        $companyProject->forceFill([
            'images' => $imagePaths,
        ])->save();
    }
}
