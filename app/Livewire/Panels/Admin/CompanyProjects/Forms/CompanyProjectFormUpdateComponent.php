<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Actions\UpdateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\UpdateCompanyProjectDto;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CompanyProjectFormUpdateComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $companyProjectUuid;

    public CompanyProjectFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('admin_livewire::company-projects.forms.company-project-form-update-component');
    }

    /*
    |-----------------------------
    | Loading Data
    |-----------------------------
    */
    public function editCompanyProject(string $companyProjectUuid): void
    {
        $this->companyProjectUuid = $companyProjectUuid;

        if ($this->companyProject) {
            $this->form->fillCompanyProject(companyProject: $this->companyProject);
        }
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function submit(): void
    {
        $this->validate();

        $updateDto = new UpdateCompanyProjectDto(
            uuid: $this->companyProjectUuid,
            title: $this->form->title,
            description: $this->form->description,
            deliveredAt: $this->form->delivered_at,
            priceStart: $this->form->price_start,
            address: $this->form->address,
            location: $this->form->location,
            images: $this->form->images,
        );

        app(UpdateCompanyProjectAction::class)
            ->execute(
                companyProject: $this->companyProject,
                dto: $updateDto
            );

        $this->dispatchCompanyProjectUpdatedEvent();
    }

    /*
    |-----------------------------
    | Computed
    |-----------------------------
    */
    #[Computed]
    public function companyProject(): ?CompanyProject
    {
        if (!$this->companyProjectUuid) {
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
    private function dispatchCompanyProjectUpdatedEvent(): void
    {
        $this->dispatch(EventsEnum::COMPANY_PROJECT_UPDATED_EVENT);
    }
}
