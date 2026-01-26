<?php

namespace App\Livewire\Guest\Projects;

use App\App\Web\Resources\CompanyProjects\CompanyProjectsResource;
use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Actions\GetVisibleCompanyProjectsAction;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProjectsComponent extends Component
{
    use WithLivewireExceptionHandling;
    use WithPagination;
    use HandlePaginationButtons;
    use WithoutUrlPagination;

    /*
    |---------------------------------
    | State
    |---------------------------------
    */
    public array $projectsData = [];
    public bool $hasMoreProjects = true;
    public bool $isProjectSection = false;
    public int $perPage = 10;

    /*
    |---------------------------------
    | Lifecycle
    |---------------------------------
    */
    public function mount(
        int $perPage = 10,
        bool $showViewAllProjectsBtn = false
    ): void {
        $this->perPage = $perPage;
        $this->isProjectSection = $showViewAllProjectsBtn;

        $this->syncState();
    }

    public function render()
    {
        return view('livewire.guest.projects.projects-component');
    }

    /*
    |---------------------------------
    | Load Data
    |---------------------------------
    */
    public function projects()
    {
        return app(GetVisibleCompanyProjectsAction::class)
            ->execute(perPage: $this->perPage);
    }

    public function viewProject($projectUuid)
    {
        $project = $this->getProject($projectUuid);

        $projectData = (new CompanyProjectsResource($project))->resolve();

        $this->dispatchCompanyProjectLoadedEvent(projectData: $projectData);
    }

    protected function syncState(): void
    {
        $paginator = $this->projects();

        $newData = CompanyProjectsResource::collection(
            $paginator->items()
        )->resolve();

        $this->projectsData = [
            ...$this->projectsData,
            ...$newData,
        ];

        $this->hasMoreProjects = $paginator->hasMorePages();
    }

    /*
    |---------------------------------
    | Actions
    |---------------------------------
    */
    public function loadMore(): void
    {
        if (! $this->projects()->hasMorePages()) {
            return;
        }

        $this->nextPage();
        $this->syncState();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    public function getProject(string $projectUuid): ?CompanyProject
    {
        if (!$projectUuid) {
            return null;
        }

        return app(GetCompanyProjectByUuidAction::class)
            ->execute(companyProjectUuid: $projectUuid);
    }

    /* 
    |-----------------------------
    | Dispatchers
    |----------------------------- 
    */
    private function dispatchCompanyProjectLoadedEvent(array $projectData)
    {
        $this->dispatch(
            EventsEnum::COMPANY_PROJECT_LOADED_EVENT,
            projectData: $projectData
        );
    }
}
