<div class="table-container">
    <x-table
        :headers="['#', 'Title', 'Description', 'Actions']"
        :rows="$companyServicesData"
        view="admin::company-services.partials.company-service-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Services ({{ $paginator->total() }})</h6>

            <x-button.primary
                class="modal-open hidden!"
                label="Create Service"
                :data-modal-id="$modalId['CREATE_COMPANY_SERVICE_MODAL']"
            />
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
        'modalId' => $modalId['VIEW_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'View Company Service',
    ])

    {{-- Company Service view modal --}}
    <x-modal.delete
        :id="$modalId['DELETE_CONTACT_MODAL']"
        title="Delete contact"
        header="Are you sure to delete the service!"
        wire:ignore
        wire:target="deleteContact"
        wire:loading.class="spinner"
    />
</div>
