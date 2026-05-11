<div class="table-container">
    <x-table
        :headers="['#', 'Title', 'Description', 'Visible', 'Actions']"
        :rows="$companyProjectsData"
        view="admin::company-projects.partials.company-project-row"
        row-name="item"
    >
        <x-slot:header>
            <h6>Projects ({{ $paginator->total() }})</h6>
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

    {{-- Delete project --}}
    <x-modal.delete
        :modalId="$modalId['DELETE_COMPANY_PROJECT_MODAL']"
        title="Delete project"
        description="Are you sure to delete the project!"
        wire:target="deleteCompanyProject"
        wire:loading.class="spinner"
    />
</div>
