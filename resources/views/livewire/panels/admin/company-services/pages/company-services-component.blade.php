<div class="table-container">
    <x-table
        :headers="['#', 'Title', 'Description', 'Actions']"
        :rows="$companyServicesData"
        view="admin::company-services.partials.company-service-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Services ({{ $paginator->total() }})</h6>
        </x-slot:header>

        <x-slot:pagination>
            {{ $paginator->onEachSide(1)->links('components.table.pagination', [
                'currentPage' => $currentPage,
                'startingPage' => $startingPage,
                'endingPage' => $endingPage,
                'lastPage' => $lastPage,
            ]) }}
        </x-slot:pagination>
    </x-table>

    {{-- Company Service view modal --}}
    @include('admin::company-services.partials.company-service-view-modal', [
        'modalId' => $modal['VIEW_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'View Company Service',
    ])

    {{-- Company Service view modal --}}
    <x-modal.delete
        :id="$modal['DELETE_COMPANY_SERVICE_MODAL']"
        title="Delete service"
        header="Are you sure to delete the service!"
        wire:ignore
        wire:target="deleteService"
        wire:loading.class="spinner"
    />
</div>
