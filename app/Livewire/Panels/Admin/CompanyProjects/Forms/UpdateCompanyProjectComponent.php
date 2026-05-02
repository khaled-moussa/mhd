<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Actions\UpdateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\UpdateCompanyProjectDto;
use App\Domain\CompanyProjects\Jobs\RemoveCompanyProjectImagesJob;
use App\Domain\CompanyProjects\Jobs\StoreCompanyProjectFilesJob;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateCompanyProjectComponent extends Component
{
    use WithLivewireExceptionHandling;
    use WithFileUploads;

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
        return view('admin_livewire::company-projects.forms.update-company-project-component');
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
            location: $this->form->resolveEmbedUrl($this->form->location),
        );

        app(UpdateCompanyProjectAction::class)->execute(
            $this->companyProject,
            $updateDto
        );

        $this->uploadProjectFiles();

        $this->resetForm();
        $this->dispatchCompanyProjectUpdatedEvent();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function uploadProjectFiles(): void
    {
        $tempImagesPaths = [];
        $tempFileData = null;

        // Multiple images
        if (!empty($this->form->images)) {
            $tempImagesPaths = collect($this->form->images)
                ->map(fn($image) => $image->getRealPath())
                ->all();
        }

        // Single file
        if (!empty($this->form->file)) {
            $tempFileData = [
                'name' => $this->form->file->getClientOriginalName(),
                'path' => $this->form->file->getRealPath(),
            ];
        }

        // Nothing to upload
        if (empty($tempImagesPaths) && is_null($tempFileData)) {
            return;
        }

        dispatch(new StoreCompanyProjectFilesJob(
            companyProject: $this->companyProject,
            tempImagesPaths: $tempImagesPaths,
            tempFileData: $tempFileData,
        ));
    }


    private function removeProjectImages(): void
    {
        dispatch(new RemoveCompanyProjectImagesJob(
            companyProject: $this->companyProject,
            removedImageIds: $this->removedImageIds
        ));
    }

    private function resetForm(): void
    {
        $this->form->resetForm();
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

        return app(GetCompanyProjectByUuidAction::class)->execute($this->companyProjectUuid);
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
