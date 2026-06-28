<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\GetCompanyProjectByUuidAction;
use App\Domain\CompanyProjects\Actions\UpdateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\UpdateCompanyProjectDto;
use App\Domain\CompanyProjects\Jobs\RemoveCompanyProjectBrochureJob;
use App\Domain\CompanyProjects\Jobs\RemoveCompanyProjectImagesJob;
use App\Domain\CompanyProjects\Jobs\StoreCompanyProjectFilesJob;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateCompanyProjectComponent extends Component
{
    use WithFileUploads;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    #[Locked]
    public string $companyProjectUuid;

    public CompanyProjectFormComponent $form;

    public array $removedImageIds = [];
    public ?string $removedFileId = null;

    /*
    |--------------------------------------------------------------------------
    | Lifecycle
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        return view('admin_livewire::company-projects.forms.update-company-project-component');
    }

    /*
    |--------------------------------------------------------------------------
    | Load Data
    |--------------------------------------------------------------------------
    */

    public function editCompanyProject(string $companyProjectUuid): void
    {
        $this->companyProjectUuid = $companyProjectUuid;

        if ($this->companyProject) {
            $this->form->fillCompanyProject(
                companyProject: $this->companyProject
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Submit Flow
    |--------------------------------------------------------------------------
    */

    public function handleSubmit(array $removedImageIds = [], ?string $removedFileId = null)
    {
        $this->removedImageIds = $removedImageIds;
        $this->removedFileId   = $removedFileId;

        $this->submit();

        if (!empty($this->removedImageIds)) {
            $this->removeProjectImages();
        }

        if (!empty($this->removedFileId)) {
            $this->removedProjectBrochure();
        }
    }

    public function submit(): void
    {
        $this->validate();

        app(UpdateCompanyProjectAction::class)->execute(
            $this->companyProject,

            new UpdateCompanyProjectDto(
                uuid: $this->companyProjectUuid,
                title: $this->form->title,
                description: $this->form->description,
                deliveredAt: $this->form->deliveredAt,
                priceStart: $this->form->priceStart,
                address: $this->form->address,
                location: $this->form->resolveEmbedUrl($this->form->location),
                visible: $this->form->visible,
            )
        );

        $this->uploadProjectFiles();

        $this->resetForm();
        $this->dispatchCompanyProjectUpdatedEvent();
    }

    /*
    |--------------------------------------------------------------------------
    | File Handling
    |--------------------------------------------------------------------------
    */

    private function uploadProjectFiles(): void
    {
        $tempImagesPaths = collect($this->form->images)
            ->filter(fn($image) => $image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            ->map(fn($image) => $image->getRealPath())
            ->values()
            ->all();

        $tempFileData = null;

        if ($this->form->file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $tempFileData = [
                'name' => $this->form->file->getClientOriginalName(),
                'path' => $this->form->file->getRealPath(),
            ];
        }

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

    private function removedProjectBrochure(): void
    {
        dispatch(new RemoveCompanyProjectBrochureJob(
            companyProject: $this->companyProject,
            removeFileId: $this->removedFileId
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function resetForm(): void
    {
        $this->form->resetForm();
    }

    private function dispatchCompanyProjectUpdatedEvent(): void
    {
        $this->dispatch(EventsEnum::COMPANY_PROJECT_UPDATED_EVENT);
    }

    /*
    |--------------------------------------------------------------------------
    | Computed
    |--------------------------------------------------------------------------
    */

    #[Computed]
    public function companyProject(): ?CompanyProject
    {
        if (!$this->companyProjectUuid) {
            return null;
        }

        return app(GetCompanyProjectByUuidAction::class)
            ->execute($this->companyProjectUuid);
    }
}
