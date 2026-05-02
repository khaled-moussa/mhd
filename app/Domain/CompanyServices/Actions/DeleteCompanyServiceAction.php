<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;
use App\Domain\Landing\Actions\ChangeLandingSectionVisibilityAction;
use App\Domain\Landing\Actions\GetSectionByKeyAction;
use App\Domain\Landing\VisibilityStates\NotVisibleState;

class DeleteCompanyServiceAction
{
    /*
    |-------------------------------
    | Delete Company Service
    |-------------------------------
    */
    public function execute(CompanyService $project): void
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
        return CompanyService::count() === 1;
    }

    /*
    |-------------------------------
    | Hide Projects Section
    |-------------------------------
    */
    private function hideProjectsSection(): void
    {
        $section = app(GetSectionByKeyAction::class)->execute('projects');

        app(ChangeLandingSectionVisibilityAction::class)
            ->execute($section, NotVisibleState::class);
    }
}