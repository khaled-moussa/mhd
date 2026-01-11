<div class="table-container">
    <x-table
        :headers="['#', 'Title', 'Description', 'User', 'Request State', 'Actions']"
        :rows="$serviceRequestsData"
        view="admin::service-requests.partials.service-request-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Service Requests ({{ $paginator->total() }})</h6>
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

    {{-- Service Request view modal --}}
    @include('admin::service-requests.partials.service-request-view-modal', [
        'modalId' => $modal['VIEW_SERVICE_REQUEST_MODAL'],
        'modalTitle' => 'View Service',
    ])
</div>
