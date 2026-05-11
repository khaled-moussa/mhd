<?php

namespace App\Livewire\Panels\Admin\CompanyServices\Forms;

use App\Domain\CompanyServices\Actions\GetCompanyServiceByUuidAction;
use App\Domain\CompanyServices\Actions\UpdateCompanyServiceAction;
use App\Domain\CompanyServices\DTOs\UpdateCompanyServiceDto;
use App\Domain\CompanyServices\Models\CompanyService;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

use function PHPUnit\Framework\stringStartsWith;

class UpdateCompanyServiceComponent extends Component
{
    // use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $companyServiceUuid;

    public CompanyServiceFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('admin_livewire::company-services.forms.update-company-service-component');
    }

    /*
    |-----------------------------
    | Loading Data
    |-----------------------------
    */
    public function editCompanyService(string $companyServiceUuid): void
    {
        $this->companyServiceUuid = $companyServiceUuid;

        if ($this->companyService) {
            $this->form->fillCompanyService($this->companyService);
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

        $updateDto = new UpdateCompanyServiceDto(
            uuid: $this->companyServiceUuid,
            icon: $this->form->icon,
            title: $this->form->title,
            description: $this->form->description,
            visible: $this->form->visible
        );

        app(UpdateCompanyServiceAction::class)->execute(
            $this->companyService,
            dto: $updateDto
        );

        $this->dispatchCompanyServiceUpdatedEvent();
    }

    /*
    |-----------------------------
    | Computed
    |-----------------------------
    */
    #[Computed]
    public function companyService(): ?CompanyService
    {
        if (!$this->companyServiceUuid) {
            return null;
        }

        return app(GetCompanyServiceByUuidAction::class)->execute($this->companyServiceUuid);
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchCompanyServiceUpdatedEvent(): void
    {
        $this->dispatch(EventsEnum::COMPANY_SERVICE_UPDATED_EVENT);
    }
}
