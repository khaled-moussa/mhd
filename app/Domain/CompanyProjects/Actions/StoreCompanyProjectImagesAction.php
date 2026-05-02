<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class StoreCompanyProjectImagesAction
{
    /*
    |-------------------------------
    | Store Project Images (Media)
    |-------------------------------
    */
    public function execute(CompanyProject $project, array $imagePaths): void
    {
        if ($imagePaths === []) {
            return;
        }

        foreach ($imagePaths as $path) {
            $project
                ->addMedia($path)
                ->toMediaCollection('images');
        }
    }
}