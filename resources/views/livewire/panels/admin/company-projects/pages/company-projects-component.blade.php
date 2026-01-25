<div class="table-container">
    <x-table
        :headers="['#', 'Title', 'Description', 'Visiblity State', 'Actions']"
        :rows="$companyProjectsData"
        view="admin::company-projects.partials.company-project-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Projects ({{ $paginator->total() }})</h6>

            <x-button.main
                class="header-btn"
                label="Create Project"
                :data-custom-open="$modal['CREATE_COMPANY_PROJECT_MODAL']"
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

    {{-- Company Project view modal --}}
    <x-modal.delete
        :id="$modal['DELETE_COMPANY_PROJECT_MODAL']"
        title="Delete project"
        header="Are you sure to delete the project!"
        wire:ignore
        wire:target="deleteProject"
        wire:loading.class="spinner"
    />
</div>
