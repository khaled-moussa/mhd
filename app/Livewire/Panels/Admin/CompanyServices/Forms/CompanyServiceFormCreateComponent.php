<?php

namespace App\Livewire\Panels\Admin\CompanyServices\Forms;

use App\Domain\CompanyServices\Actions\CreateCompanyServiceAction;
use App\Domain\CompanyServices\DTOs\CreateCompanyServiceDto;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class CompanyServiceFormCreateComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public CompanyServiceFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('admin_livewire::company-services.forms.company-service-form-create-component');
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function submit(): void
    {
        $this->form->validate();

        $createDto = new CreateCompanyServiceDto(
            title: $this->form->title,
            description: $this->form->description,
        );

        app(CreateCompanyServiceAction::class)->execute(dto: $createDto);

        $this->resetForm();
        $this->dispatchCompanyServiceCreatedEvent();
    }
    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function resetForm()
    {
        $this->form->resetForm();
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchCompanyServiceCreatedEvent(): void
    {
        $this->dispatch(EventsEnum::COMPANY_SERVICE_CREATED_EVENT);
    }
}
