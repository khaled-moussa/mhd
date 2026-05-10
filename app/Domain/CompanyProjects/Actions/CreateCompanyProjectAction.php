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

        $this->ensureProjectsSectionIsVisible();

        return $project;
    }

    /*
    |-------------------------------
    | Ensure Projects Section Visible
    |-------------------------------
    */
    private function ensureProjectsSectionIsVisible(): void
    {
        $section = app(GetSectionByKeyAction::class)->execute('projects');

        if ($section->isVisible()) {
            return;
        }

        app(ChangeLandingSectionVisibilityAction::class)
            ->execute($section, VisibleState::class);
    }
}
