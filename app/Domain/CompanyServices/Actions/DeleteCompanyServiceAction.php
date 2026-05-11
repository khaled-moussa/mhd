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
        if ($this->isLastService()) {
            $this->hideServicesSection();
        }

        $project->delete();
    }

    /*
    |-------------------------------
    | Check Last Service
    |-------------------------------
    */
    private function isLastService(): bool
    {
        return CompanyService::count() === 1;
    }

    /*
    |-------------------------------
    | Hide Services Section
    |-------------------------------
    */
    private function hideServicesSection(): void
    {
        $section = app(GetSectionByKeyAction::class)->execute('services');

        if (!$section) {
            return;
        }

        app(ChangeLandingSectionVisibilityAction::class)
            ->execute($section, NotVisibleState::class);
    }
}
