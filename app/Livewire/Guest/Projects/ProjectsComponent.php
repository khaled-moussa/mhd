<?php

namespace App\Livewire\Guest\Projects;

use App\App\Web\Resources\CompanyProjects\CompanyProjectsResource;
use App\Domain\CompanyProjects\Actions\GetVisibleCompanyProjectsAction;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProjectsComponent extends Component
{
    // use WithLivewireExceptionHandling;
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
    public bool $showViewAllProjectsBtn = false;

    public int $perPage = 10;

    /*
    |---------------------------------
    | Lifecycle
    |---------------------------------
    */
    public function mount(int $perPage = 10, bool $showViewAllProjectsBtn = false): void
    {
        $this->perPage = $perPage;
        $this->showViewAllProjectsBtn = $showViewAllProjectsBtn;

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
    protected function syncState(): void
    {
        $paginator = $this->companyProjects();

        $newData = CompanyProjectsResource::collection(
            $paginator->items()
        )->resolve();

        $this->projectsData = [
            ...$this->projectsData,
            ...$newData,
        ];

        $this->hasMoreProjects = $paginator->hasMorePages();
    }

    public function companyProjects()
    {
        return app(GetVisibleCompanyProjectsAction::class)
            ->execute(perPage: $this->perPage);
    }

    /*
    |---------------------------------
    | Actions
    |---------------------------------
    */
    public function loadMore(): void
    {
        if (! $this->companyProjects()->hasMorePages()) {
            return;
        }

        $this->nextPage();
        $this->syncState();
    }
}
