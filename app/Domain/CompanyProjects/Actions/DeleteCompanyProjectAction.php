<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Domain\Landing\Actions\ChangeLandingSectionVisibilityAction;
use App\Domain\Landing\Actions\GetSectionByKeyAction;
use App\Domain\Landing\VisibilityStates\NotVisibleState;

class DeleteCompanyProjectAction
{
    /*
    |-------------------------------
    | Delete Company Project
    |-------------------------------
    */
    public function execute(CompanyProject $project): void
    {
        if ($this->isLastProject()) {
            $this->hideProjectsSection();
        }

        $project->delete();
    }

    /*
    |-------------------------------
    | Check Last Project
    |-------------------------------
    */
    private function isLastProject(): bool
    {
        return CompanyProject::count() === 1;
    }

    /*
    |-------------------------------
    | Hide Projects Section
    |-------------------------------
    */
    private function hideProjectsSection(): void
    {
        $section = app(GetSectionByKeyAction::class)->execute('projects');

        if (!$section) {
            return;
        }

        app(ChangeLandingSectionVisibilityAction::class)
            ->execute($section, NotVisibleState::class);
    }
}
