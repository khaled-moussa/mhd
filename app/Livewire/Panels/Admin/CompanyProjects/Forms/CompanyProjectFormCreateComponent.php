<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Actions\CreateCompanyProjectAction;
use App\Domain\CompanyProjects\DTOs\CreateCompanyProjectDto;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class CompanyProjectFormCreateComponent extends Component
{
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

        $createDto = new CreateCompanyProjectDto(
            title: $this->form->title,
            description: $this->form->description,
            deliveredAt: $this->form->delivered_at,
            priceStart: $this->form->price_start,
            address: $this->form->address,
            location: $this->form->location,
            images: $this->form->images,
        );

        app(CreateCompanyProjectAction::class)
            ->execute(dto: $createDto);

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
