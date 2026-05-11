<section
    id="projects"
    class="projects"
>
    <div class="projects-container">

        {{-- Header --}}
        <x-header.section
            label="What we've built"
            title="Our Projects"
        />

        @livewire('guest.projects.projects-component')
    </div>
</section>

{{-- Modal --}}
@include('pages.landing.projects.partials.view-project', [
    'modalId' => $modalId['VIEW_COMPANY_PROJECT_MODAL'],
])
