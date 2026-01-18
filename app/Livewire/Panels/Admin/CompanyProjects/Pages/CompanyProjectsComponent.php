<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Pages;

use App\App\Web\Resources\CompanyProjects\CompanyProjectsResource;
use App\Domain\CompanyProjects\Actions\DeleteCompanyProjectAction;
use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Actions\GetCompanyProjectsAction;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Livewire\Panels\Admin\CompanyProjects\Forms\CompanyProjectFormComponent;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyProjectsComponent extends Component
{
    // use WithLivewireExceptionHandling;
    use WithPagination;
    use HandlePaginationButtons;

    /* 
    |-----------------------------
    | Properties
    |----------------------------- 
    */
    public CompanyProjectFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        $this->initPaginationButtons($this->companyProjects);

        return view('admin_livewire::company-projects.pages.company-projects-component', [
            'paginator' => $this->companyProjects,
            'companyProjectsData' => $this->companyProjectsData,
        ]);
    }

    /* 
    |-----------------------------
    | Computed Properties
    |----------------------------- 
    */
    #[Computed]
    public function companyProjects()
    {
        return app(GetCompanyProjectsAction::class)->execute();
    }

    #[Computed]
    public function companyProjectsData(): array
    {
        return CompanyProjectsResource::collection(
            $this->companyProjects->items()
        )->resolve();
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function viewCompanyProject(string $companyProjectUuid): void
    {
        $companyProject = $this->getCompanyProject($companyProjectUuid);

        if ($companyProject) {
            $this->form->fillCompanyProject(companyProject: $companyProject);
        }
    }

    public function deleteCompanyProject(string $companyProjectUuid): void
    {
        $companyProject = $this->getCompanyProject($companyProjectUuid);

        app(DeleteCompanyProjectAction::class)
            ->execute(companyProject: $companyProject);

        // If current page becomes empty → go back
        if ($this->companyProjects->count() === 0 && $this->currentPage > 1) {
            $this->previousPage();
        }

        $this->dispatchCompanyProjectDeletedEvent();
    }

    /* 
    |-----------------------------
    | Event Listeners
    |----------------------------- 
    */
    #[On(EventsEnum::COMPANY_PROJECT_CREATED_EVENT->value)]
    public function handleCompanyProjectCreated(): void
    {
        $this->resetPage();
    }

    #[On(EventsEnum::COMPANY_PROJECT_UPDATED_EVENT->value)]
    public function handleCompanyProjectUpdated(): void
    {
        // simply re-render
    }

    /* 
    |-----------------------------
    | Helpers
    |----------------------------- 
    */
    private function getCompanyProject(string $companyProjectUuid): ?CompanyProject
    {
        return app(GetCompanyProjectByUuidAction::class)
            ->execute(companyProjectUuid: $companyProjectUuid);
    }

    /* 
    |-----------------------------
    | Dispatchers
    |----------------------------- 
    */
    private function dispatchCompanyProjectDeletedEvent()
    {
        $this->dispatch(EventsEnum::COMPANY_PROJECT_DELETED_EVENT);
    }
}
