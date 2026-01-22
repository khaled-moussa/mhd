@props([
    'section' => [],
    'perPage' => 6,
    'showViewAllProjectsBtn' => false,
])

<section
    id="projects"
    class="projects"
>
    <div
        id="projects-container"
        class="projects__container"
    >

        {{-- Header Section --}}
        <x-header.section
            :title="$section['title']"
            :description="$section['description']"
        />

        {{-- Projects livewire component --}}
        <livewire:guest.projects.projects-component
            :perPage="$perPage"
            :showViewAllProjectsBtn="$showViewAllProjectsBtn"
        />
    </div>
</section>

{{-- Project Modal --}}
@include('pages.guest.projects.partials.project-modal', [
    'modalId' => $modal['VIEW_COMPANY_PROJECT_MODAL'],
    'title' => 'Modern Apartment Project',
    'description' => 'A modern apartment complex in Masr Gdeda.',
])
