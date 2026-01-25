<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class AttemptToStoreImagesAction
{
    /**
     * Attempet to store images in spatie media.
     */
    public function execute(CompanyProject $project, array $tempImagesPaths)
    {
        foreach ($tempImagesPaths as $imagePath) {
            $project->addMedia($imagePath)
                    ->toMediaCollection('images');
        }
    }
}
