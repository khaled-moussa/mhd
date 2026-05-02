<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\DTOs\CreateCompanyProjectDto;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Domain\Landing\Actions\ChangeLandingSectionVisibilityAction;
use App\Domain\Landing\Actions\GetSectionByKeyAction;
use App\Domain\Landing\VisibilityStates\VisibleState;

class CreateCompanyProjectAction
{
    /*
    |-------------------------------
    | Create Company Project
    |-------------------------------
    */
    public function execute(CreateCompanyProjectDto $dto): CompanyProject
    {
        $project = CompanyProject::create($dto->toArray());

        $this->ensureProjectsSectionVisible();

        return $project;
    }

    /*
    |-------------------------------
    | Ensure Projects Section Visible
    |-------------------------------
    */
    private function ensureProjectsSectionVisible(): void
    {
        $section = app(GetSectionByKeyAction::class)->execute('projects');

        // Only change if not already visible
        if (! $section->isVisible()) {
            app(ChangeLandingSectionVisibilityAction::class)->execute($section, VisibleState::class);
        }
    }
}
