<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Actions\UpdateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\UpdateCompanyProjectDto;
use App\Domain\CompanyProjects\Jobs\RemoveCompanyProjectImagesJob;
use App\Domain\CompanyProjects\Jobs\StoreCompanyProjectImagesJob;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyProjectFormUpdateComponent extends Component
{
    use WithFileUploads;
    // use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $companyProjectUuid;

    public CompanyProjectFormComponent $form;

    public array $removedImageIds = [];

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
    public function handleSubmit(array $removedImageIds = [])
    {
        if (!empty($removedImageIds)) {
            $this->removedImageIds = $removedImageIds;
            $this->removeProjectImages();
        }

        $this->submit();
    }
    public function submit(): void
    {
        $this->validate();

        $updateDto = new UpdateCompanyProjectDto(
            uuid: $this->companyProjectUuid,
            title: $this->form->title,
            description: $this->form->description,
            deliveredAt: $this->form->deliveredAt,
            priceStart: $this->form->priceStart,
            address: $this->form->address,
            location: $this->form->location,
            visible: $this->form->visible
        );

        app(UpdateCompanyProjectAction::class)
            ->execute(
                companyProject: $this->companyProject,
                dto: $updateDto
            );

        if (!empty($this->form->images)) {
            $this->uploadProjectImages();
        }

        $this->dispatchCompanyProjectUpdatedEvent();
    }

    private function uploadProjectImages(): void
    {
        dispatch(new StoreCompanyProjectImagesJob(
            companyProject: $this->companyProject,
            tempPaths: collect($this->form->images)
                ->map(fn($file) => $file->getRealPath())
                ->toArray(),
        ));
    }

    private function removeProjectImages(): void
    {
        dispatch(new RemoveCompanyProjectImagesJob(
            companyProject: $this->companyProject,
            removedImageIds: $this->removedImageIds
        ));
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
