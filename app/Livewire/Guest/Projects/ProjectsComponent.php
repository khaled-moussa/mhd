<?php

namespace App\Livewire\Guest\Projects;

use App\Domain\CompanyProjects\Actions\GetCompanyProjectsAction;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsComponent extends Component
{
    /*
    |------------------------------------------------------------------
    | Properties
    |------------------------------------------------------------------
    */

    public int $perPage = 50;

    /*
    |------------------------------------------------------------------
    | Lifecycle
    |------------------------------------------------------------------
    */

    public function render()
    {
        return view('livewire.guest.projects.projects-component', [
            'projects'        => $this->projectsData,
            'hasMoreProjects' => $this->hasMoreProjects(),
        ]);
    }

    /*
    |------------------------------------------------------------------
    | Actions
    |------------------------------------------------------------------
    */

    public function loadMore(): void
    {
        $this->perPage += 50;
    }

    /*
    |------------------------------------------------------------------
    | Helpers
    |------------------------------------------------------------------
    */

    public function hasMoreProjects(): bool
    {
        return $this->companyProjects->count() > $this->perPage;
    }

    /*
    |------------------------------------------------------------------
    | Computed Properties
    |------------------------------------------------------------------
    */

    #[Computed]
    public function companyProjects()
    {
        return app(GetCompanyProjectsAction::class)
            ->execute(visible: true);
    }

    #[Computed]
    public function projectsData(): array
    {
        return $this->companyProjects
            ->take($this->perPage)
            ->toResourceCollection()
            ->resolve();
    }
}
