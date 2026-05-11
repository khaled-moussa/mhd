<div class="table-container">
    <x-table
        :headers="['#', 'Name', 'Email', 'Phone', 'Actions']"
        :rows="$contactsData"
        view="admin::contacts.partials.contact-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Contacts ({{ $paginator->total() }})</h6>
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

    {{-- Contact view modal --}}
    <x-modal.delete
        :modalId="$modalId['DELETE_CONTACT_MODAL']"
        title="Delete contact"
        description="Are you sure to delete the contact!"
    />
</div>
