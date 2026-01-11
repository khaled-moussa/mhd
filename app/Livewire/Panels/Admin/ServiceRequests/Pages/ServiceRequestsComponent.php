<?php

namespace App\Livewire\Panels\Admin\ServiceRequests\Pages;

use App\App\Web\Resources\ServiceRequests\ServiceRequestResource;
use App\Domain\CompanyServices\Actions\DeleteCompanyServiceAction;
use App\Domain\ServiceRequests\Actions\GetServiceRequestByUuidAction;
use App\Domain\ServiceRequests\Actions\GetServiceRequestsAction;
use App\Domain\ServiceRequests\Models\ServiceRequest;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceRequestsComponent extends Component
{
    use WithLivewireExceptionHandling;
    use WithPagination;
    use HandlePaginationButtons;

    /* 
    |-----------------------------
    | Properties
    |----------------------------- 
    */
    public array $selectedServiceRequestData = [];

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        $this->initPaginationButtons($this->serviceRequests);

        return view('admin_livewire::service-requests.pages.service-requests-component', [
            'paginator' => $this->serviceRequests,
            'serviceRequestsData' => $this->serviceRequestsData,
        ]);
    }

    /* 
    |-----------------------------
    | Computed Properties
    |----------------------------- 
    */
    #[Computed]
    public function serviceRequests()
    {
        return app(GetServiceRequestsAction::class)->execute();
    }


    #[Computed]
    public function serviceRequestsData(): array
    {
        return ServiceRequestResource::collection(
            $this->serviceRequests->items()
        )->resolve();
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function viewServiceRequest(string $serviceRequestUuid): void
    {
        $serviceRequest = $this->getServiceRequest($serviceRequestUuid);

        if (! $serviceRequest) {
            return;
        }

        $this->selectedServiceRequestData = (new ServiceRequestResource(
            $serviceRequest
        ))->resolve();
    }

    public function deleteService(string $serviceRequestUuid): void
    {
        $companyService = $this->getCompanyServiceRequest($serviceRequestUuid);

        app(DeleteCompanyServiceAction::class)
            ->execute(companyService: $companyService);

        // If current page becomes empty → go back
        if ($this->serviceRequests->count() === 0 && $this->currentPage > 1) {
            $this->previousPage();
        }

        $this->dispatchServiceRequestDeletedEvent();
    }

    /* 
    |-----------------------------
    | Event Listeners
    |----------------------------- 
    */
    #[On(EventsEnum::SERVICE_REQUEST_CREATED_EVENT->value)]
    public function handleServiceRequestCreated(): void
    {
        $this->resetPage();
    }

    #[On(EventsEnum::SERVICE_REQUEST_UPDATED_EVENT->value)]
    public function handleServiceRequestUpdated(): void
    {
        // simply re-render
    }

    /* 
    |-----------------------------
    | Helpers
    |----------------------------- 
    */
    private function getServiceRequest(string $serviceRequestUuid): ?ServiceRequest
    {
        return app(GetServiceRequestByUuidAction::class)
            ->execute(serviceRequestUuid: $serviceRequestUuid);
    }

    /* 
    |-----------------------------
    | Dispatchers
    |----------------------------- 
    */
    private function dispatchServiceRequestDeletedEvent()
    {
        $this->dispatch(EventsEnum::SERVICE_REQUEST_DELETED_EVENT);
    }
}
