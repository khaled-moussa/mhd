<div class="projects-wrapper">

    {{-- Projects Grid --}}
    <div class="projects-grid">
        @foreach ($projects as $project)
            <div
                class="projects-card"
                onclick='openProject(@json($project))'
            >
                {{-- Image --}}
                <div class="projects-image">
                    <img
                        src="{{ $project['image_cover'] }}"
                        alt="{{ $project['title'] }}"
                    />

                    <div class="projects-overlay">
                        <div class="projects-overlay-btn">
                            <i class="fi fi-rr-arrow-up-right text-primary text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="projects-content">
                    <div class="projects-meta">
                        <div class="projects-meta-dot"></div>

                        <span class="projects-address">
                            {{ $project['address'] }}
                        </span>
                    </div>

                    <h3 class="projects-title">
                        {{ $project['title'] }}
                    </h3>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Load More --}}
    @if ($hasMoreProjects)
        <div class="projects-load-more">
            <x-button.primary
                label="Load More"
                wire:click="loadMore"
                wire:loading.attr="disabled"
                wire:target="loadMore"
                wire:loading.class="spinner"
            />
        </div>
    @endif
</div>