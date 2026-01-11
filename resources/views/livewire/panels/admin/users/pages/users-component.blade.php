<div
    class="table-container"
    x-data="usersComponent"
>
    <x-table
        :headers="['#', 'Full Name', 'Email', 'Phone', 'Actions']"
        :rows="$usersData"
        view="pages.panels.admin.users.partials.user-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Users
                ({{ $paginator->total() }})
            </h6>
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

    {{-- User view modal --}}
    @include('pages.panels.admin.users.partials.user-view-modal', [
        'modalId' => $modal['VIEW_USER_MODAL'],
        'modalTitle' => 'View User',
    ])

    {{-- User delete modal --}}
    <x-modal.delete
        :id="$modal['DELETE_USER_MODAL']"
        title="Delete user"
        header="Are you sure to delete the user!"
        wire:ignore
        wire:loading.class="spinner"
        wire:target="deleteUser"
    />
</div>
