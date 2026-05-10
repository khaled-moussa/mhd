<div class="table-container">
    <x-table
        :headers="['#', 'Title', 'Description', 'Visible', 'Actions']"
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
    <x-modal.delete
        :modalId="$modalId['DELETE_COMPANY_SERVICE_MODAL']"
        title="Delete service"
        description="Are you sure to delete the service!"
        wire:ignore
        wire:target="deleteService"
        wire:loading.class="spinner"
    />
</div>
