<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\CreateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\CreateCompanyProjectDto;
use App\Domain\CompanyProjects\Jobs\StoreCompanyProjectImagesJob;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyProjectFormCreateComponent extends Component
{
    use WithFileUploads;
    use WithLivewireExceptionHandling;

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
        return view('admin_livewire::company-projects.forms.company-project-form-create-component');
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
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
                location: $this->form->location,
            )
        );

        $imagePaths = collect($this->form->images)
            ->map(fn($file) => $file->store('company-projects/tmp', 'public'))
            ->toArray();

        StoreCompanyProjectImagesJob::dispatch(
            companyProject: $project,
            imagePaths: $imagePaths,
        );

        $this->resetForm();
        $this->dispatchCompanyProjectCreatedEvent();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
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
