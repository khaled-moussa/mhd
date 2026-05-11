<div x-data="projectViewComponent">
    {{-- Modal --}}
    @include('pages.landing.projects.partials.view-project', [
        'modalId' => $modalId['VIEW_COMPANY_PROJECT_MODAL'],
    ])
</div>
