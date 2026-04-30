@props(['projects' => []])

<section id="projects" class="projects">
    <div class="projects-container">

        {{-- Header --}}
        <x-header.section label="What we've built" title="Our Projects">
            <x-button.link class="projects-view-all" label="View all projects" path="#">
                <i class="fi fi-rr-arrow-right"></i>
            </x-button.link>
        </x-header.section>

        {{-- Grid --}}
        <div class="projects-grid">
            @foreach($projects['data'] as $project)
                <div class="projects-card" onclick='openProject(@json($project))'>

                    {{-- Image --}}
                    <div class="projects-image">
                        <img src="{{ $project['cover'] }}" alt="{{ $project['title'] }}"/>
                        <div class="projects-overlay">
                            <div class="projects-overlay-btn">
                                <i class="fi fi-rr-arrow-up-right text-primary text-sm"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="projects-content">
                        <div class="projects-meta">
                            <span class="projects-delivered">{{ $project['delivered'] }}</span>
                            <div class="projects-meta-dot"></div>
                            <span class="projects-address">{{ $project['address'] }}</span>
                        </div>

                        <h3 class="projects-title">{{ $project['title'] }}</h3>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Modal --}}
@include('pages.guest.projects.partials.project-modal', [
    'modalId' => $modalId['VIEW_COMPANY_PROJECT_MODAL'],
])