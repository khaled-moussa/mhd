<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\CreateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\CreateCompanyProjectDto;
use App\Domain\CompanyProjects\Jobs\StoreCompanyProjectFilesJob;
use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCompanyProjectComponent extends Component
{
    use WithLivewireExceptionHandling;
    use WithFileUploads;

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
        return view('admin_livewire::company-projects.forms.create-company-project-component');
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function handleSubmit(): void
    {
        if (empty($this->form->images)) {
            return;
        }

        $this->submit();
    }

    public function submit(): void
    {
        $this->form->validate();

        $project = app(CreateCompanyProjectAction::class)->execute(
            new CreateCompanyProjectDto(
                title: $this->form->title,
                description: $this->form->description,
                deliveredAt: $this->form->deliveredAt,
                priceStart: $this->form->priceStart,
                address: $this->form->address,
                location: $this->form->resolveEmbedUrl($this->form->location),
            )
        );

        $this->uploadProjectFiles($project);

        $this->resetForm();
        $this->dispatchCompanyProjectCreatedEvent();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function uploadProjectFiles(CompanyProject $project): void
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
            companyProject: $project,
            tempImagesPaths: $tempImagesPaths,
            tempFileData: $tempFileData,
        ));
    }

    private function resetForm(): void
    {
        $this->form->resetForm();
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchCompanyProjectCreatedEvent(): void
    {
        $this->dispatch(EventsEnum::COMPANY_PROJECT_CREATED_EVENT);
    }
}
