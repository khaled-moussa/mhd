<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class AttemptToStoreBrochureAction
{
    /**
     * Attempet store to file in spatie media.
     */
    public function execute(CompanyProject $project, array $tempFileData)
    {
        // Clear existing file first
        $project->clearMediaCollection('file');

        $project
            ->addMedia($tempFileData['path'])
            ->usingName($tempFileData['name'])
            ->toMediaCollection('file');
    }
}
