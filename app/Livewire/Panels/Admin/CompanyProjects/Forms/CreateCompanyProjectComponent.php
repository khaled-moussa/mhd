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
    // use WithLivewireExceptionHandling;
    use WithFileUploads;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    public CompanyProjectFormComponent $form;

    /*
    |--------------------------------------------------------------------------
    | Lifecycle
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        return view('admin_livewire::company-projects.forms.create-company-project-component');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function handleSubmit(): void
    {
        if (empty($this->form->images)) {
            return;
        }

        $this->form->validate();

        $project = app(CreateCompanyProjectAction::class)->execute(
            new CreateCompanyProjectDto(
                title: $this->form->title,
                description: $this->form->description,
                deliveredAt: $this->form->deliveredAt,
                priceStart: $this->form->priceStart,
                address: $this->form->address,
                location: $this->form->resolveEmbedUrl($this->form->location),
                visible: $this->form->visible,
            )
        );

        $this->dispatchFiles($project);

        $this->form->resetForm();

        $this->dispatch(EventsEnum::COMPANY_PROJECT_CREATED_EVENT);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function dispatchFiles(CompanyProject $project): void
    {
        $imagePaths = collect($this->form->images)
            ->map(fn($image) => $image->getRealPath())
            ->filter()
            ->values()
            ->all();

        $fileData = $this->form->file
            ? [
                'name' => $this->form->file->getClientOriginalName(),
                'path' => $this->form->file->getRealPath(),
            ]
            : null;

        if (empty($imagePaths) && is_null($fileData)) {
            return;
        }

        dispatch(new StoreCompanyProjectFilesJob(
            companyProject: $project,
            tempImagesPaths: $imagePaths,
            tempFileData: $fileData,
        ));
    }
}
