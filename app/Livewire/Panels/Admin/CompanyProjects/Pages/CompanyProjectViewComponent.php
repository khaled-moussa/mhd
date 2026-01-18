<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Pages;

use App\App\Web\Resources\CompanyProjects\CompanyProjectsResource;
use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CompanyProjectViewComponent extends Component
{
    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $companyProjectUuid = '';
    public array $companyProjectData = [];

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view(
            'admin_livewire::company-projects.pages.company-project-view-component'
        );
    }

    /*
    |-----------------------------
    | Loading Data
    |-----------------------------
    */
    public function viewCompanyProject(string $companyProjectUuid): void
    {
        $this->companyProjectUuid = $companyProjectUuid;
        $this->companyProjectData = $this->getCompanyProjectData();

        if (!empty($this->companyProjectData)) {
            $this->dispatchCompanyProjectLoadedEvent();
        }
    }

    public function getCompanyProjectData(): array
    {
        if (! $this->companyProject) {
            return [];
        }

        return (new CompanyProjectsResource(
            $this->companyProject
        ))->resolve();
    }

    /*
    |-----------------------------
    | Computed
    |-----------------------------
    */
    #[Computed]
    public function companyProject(): ?CompanyProject
    {
        if ($this->companyProjectUuid === '') {
            return null;
        }

        return app(GetCompanyProjectByUuidAction::class)
            ->execute(companyProjectUuid: $this->companyProjectUuid);
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchCompanyProjectLoadedEvent(): void
    {
        $this->dispatch(
            EventsEnum::COMPANY_PROJECT_LOADED_EVENT,
            projectData: $this->companyProjectData
        );
    }
}
