<div x-data="projectViewComponent">
    {{-- Modal --}}
    @include('pages.guest.projects.partials.project-modal', [
        'modalId' => $modalId['VIEW_COMPANY_PROJECT_MODAL'],
    ])
</div>
