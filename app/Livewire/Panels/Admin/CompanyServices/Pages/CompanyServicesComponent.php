<?php

namespace App\Livewire\Panels\Admin\CompanyServices\Pages;

use App\App\Web\Resources\CompanyServices\CompanyServicesResource;
use App\Domain\CompanyServices\Actions\DeleteCompanyServiceAction;
use App\Domain\CompanyServices\Actions\GetCompanyServiceByUuidAction;
use App\Domain\CompanyServices\Actions\GetCompanyServicesAction;
use App\Domain\CompanyServices\Models\CompanyService;
use App\Livewire\Panels\Admin\CompanyServices\Forms\CompanyServiceFormComponent;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyServicesComponent extends Component
{
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
        $companyServices = $this->companyServices();

        $this->initPaginationButtons($companyServices);

        return view('admin_livewire::company-services.pages.company-services-component', [
            'paginator' => $companyServices,
            'companyServicesData' => $this->companyServicesData($companyServices),
        ]);
    }

    /*
    |-----------------------------
    | Data
    |-----------------------------
    */
    public function companyServices()
    {
        return app(GetCompanyServicesAction::class)->paginate();
    }

    public function companyServicesData($companyServices): array
    {
        return CompanyServicesResource::collection($companyServices->items())->resolve();
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function viewCompanyService(string $companyServiceUuid): void
    {
        $companyService = $this->getCompanyService($companyServiceUuid);

        if (!$companyService) {
            return;
        }

        $this->dispatchCompanyServiceLoadedEvent(
            $companyService->toResource()->resolve()
        );
    }

    public function deleteCompanyService(string $companyServiceUuid): void
    {
        $companyService = $this->getCompanyService($companyServiceUuid);

        app(DeleteCompanyServiceAction::class)->execute($companyService);

        // If current page becomes empty → go back
        if ($this->companyServices()->count() === 0 && $this->currentPage > 1) {
            $this->previousPage();
        }

        if ($this->currentPage === 1) {
            $this->resetPage();
        }

        $this->dispatchCompanyServiceDeletedEvent();
    }

    /*
    |-----------------------------
    | Events
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
        // no action needed (auto re-render)
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function getCompanyService(string $companyServiceUuid): ?CompanyService
    {
        return app(GetCompanyServiceByUuidAction::class)
            ->execute($companyServiceUuid);
    }

    /*
    |-----------------------------
    | Dispatchers
    |-----------------------------
    */
    private function dispatchCompanyServiceLoadedEvent(array $data): void
    {
        $this->dispatch(EventsEnum::COMPANY_SERVICE_LOADED_EVENT, data: $data);
    }

    private function dispatchCompanyServiceDeletedEvent(): void
    {
        $this->dispatch(EventsEnum::COMPANY_SERVICE_DELETED_EVENT);
    }
}
