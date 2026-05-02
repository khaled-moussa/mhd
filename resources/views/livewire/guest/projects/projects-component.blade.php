@props([
    'section' => [],
])

<section id="projects" class="projects">
    <div class="projects__container">

        {{-- Header --}}
        <div class="projects__header">
            <div class="projects__header-left">
                <span class="section-label">What we've built</span>
                <h2>{{ $section['title'] ?? 'Our Projects' }}</h2>
            </div>

            @if ($isProjectSection && !empty($projectsData))
                <x-button.link
                    class="projects__view-all"
                    label="View all projects"
                    :path="route('projects')"
                >
                    <i class="fi fi-rr-arrow-right"></i>
                </x-button.link>
            @endif
        </div>

        {{-- Grid --}}
        <div x-data="projectsComponent">
            <div class="projects__grid">
                @forelse ($projectsData as $project)
                    <div
                        class="projects__card"
                        @click="viewProject(`{{ $project['uuid'] }}`)"
                        wire:loading.class="spinner"
                        wire:target="viewProject('{{ $project['uuid'] }}')"
                    >
                        <div class="projects__image">
                            <img src="{{ $project['image_cover'] }}" alt="{{ $project['title'] }}" />
                            <div class="projects__overlay">
                                <div class="projects__overlay-btn">
                                    <i class="fi fi-rr-arrow-up-right text-primary text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <div class="projects__content">
                            <div class="projects__meta">
                                <span class="projects__date">{{ $project['delivered_at'] }}</span>
                                @if ($project['address'])
                                    <div class="projects__meta-dot"></div>
                                    <span class="projects__location">{{ $project['address'] }}</span>
                                @endif
                            </div>
                            <h3 class="projects__title">{{ $project['title'] }}</h3>
                        </div>
                    </div>
                @empty
                    <div class="empty">No projects found</div>
                @endforelse
            </div>

            {{-- Load More --}}
            @if (!$isProjectSection)
                <div class="projects__load-more">
                    <x-button.outlined
                        label="Load more"
                        wire:click="loadMore"
                        wire:target="loadMore"
                        wire:loading.class="spinner"
                        :disabled="!$hasMoreProjects"
                    />
                </div>
            @endif
        </div>

    </div>
</section>