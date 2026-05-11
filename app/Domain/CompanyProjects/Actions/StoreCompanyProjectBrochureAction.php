<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class StoreCompanyProjectBrochureAction
{
    /*
    |-------------------------------
    | Store Company Project Brochure
    |-------------------------------
    */
    public function execute(CompanyProject $project, array $fileData): void
    {
        if (empty($fileData['path'])) {
            return;
        }

        // Clear existing file
        $project->clearMediaCollection('borchure');

        $project
            ->addMedia($fileData['path'])
            ->usingName($fileData['name'] ?? 'brochure')
            ->toMediaCollection('brochure');
    }
}