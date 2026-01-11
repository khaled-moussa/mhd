<?php

namespace App\Livewire\Panels\Admin\CompanyServices\Pages;

use App\App\Web\Resources\CompanyServices\CompanyServicesResource;
use App\Domain\CompanyServices\Actions\DeleteCompanyServiceAction;
use App\Domain\CompanyServices\Actions\GetCompanyServiceByUuidAction;
use App\Domain\CompanyServices\Actions\GetCompanyServicesAction;
use App\Domain\CompanyServices\Models\CompanyService;
use App\Livewire\Panels\Admin\CompanyServices\Forms\CompanyServiceFormComponent;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyServicesComponent extends Component
{
    use WithLivewireExceptionHandling;
    use WithPagination;
    use HandlePaginationButtons;

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
        $this->initPaginationButtons($this->companyServices);

        return view('admin_livewire::company-services.pages.company-services-component', [
            'paginator' => $this->companyServices,
            'companyServicesData' => $this->companyServicesData,
        ]);
    }

    /* 
    |-----------------------------
    | Computed Properties
    |----------------------------- 
    */
    #[Computed]
    public function companyServices()
    {
        return app(GetCompanyServicesAction::class)->execute();
    }


    #[Computed]
    public function companyServicesData(): array
    {
        return CompanyServicesResource::collection(
            $this->companyServices->items()
        )->resolve();
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function viewCompanyService(string $companyServiceUuid): void
    {
        $companyService = $this->getCompanyService($companyServiceUuid);

        if ($companyService) {
            $this->form->fillCompanyService(companyService: $companyService);
        }
    }

    public function deleteCompanyService(string $companyServiceUuid): void
    {
        $companyService = $this->getCompanyService($companyServiceUuid);

        app(DeleteCompanyServiceAction::class)
            ->execute(companyService: $companyService);

        // If current page becomes empty → go back
        if ($this->companyServices->count() === 0 && $this->currentPage > 1) {
            $this->previousPage();
        }

        $this->dispatchCompanyServiceDeletedEvent();
    }

    /* 
    |-----------------------------
    | Event Listeners
    |----------------------------- 
    */
    #[On(EventsEnum::COMPANY_SERVICE_CREATED_EVENT->value)]
    public function handleCompanyServiceCreated(): void
    {
        $this->resetPage();
    }

    #[On(EventsEnum::COMPANY_SERVICE_UPDATED_EVENT->value)]
    public function handleCompanyServiceUpdated(): void
    {
        // simply re-render
    }

    /* 
    |-----------------------------
    | Helpers
    |----------------------------- 
    */
    private function getCompanyService(string $companyServiceUuid): ?CompanyService
    {
        return app(GetCompanyServiceByUuidAction::class)
            ->execute(companyServiceUuid: $companyServiceUuid);
    }

    /* 
    |-----------------------------
    | Dispatchers
    |----------------------------- 
    */
    private function dispatchCompanyServiceDeletedEvent()
    {
        $this->dispatch(EventsEnum::COMPANY_SERVICE_DELETED_EVENT);
    }
}
