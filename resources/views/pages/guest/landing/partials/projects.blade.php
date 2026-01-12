@props([
    'section' => [],
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
            title="{{ $section['title'] }}"
            paragraph="{{ $section['description'] }}"
        />

        {{-- Projects Grid --}}
        <div class="projects__grid">
            @foreach ($section['data'] as $project)
                <div
                    class="projects__card"
                    onclick="viewProject(@js($project))"
                >
                    <x-asset.img
                        folder="backgrounds"
                        :img="$project['img']"
                        class="projects__image"
                    />

                    <div class="projects__content">
                        <h3 class="projects__title">{{ $project['title'] }}</h3>
                        <p class="projects__desc">{{ $project['delivered'] }}</p>
                        <p class="projects__desc">{{ $project['address'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Load More Button --}}
        <div class="projects__load-more">
            <x-button.outline
                id="projects-load-more"
                label="Load more"
            />
        </div>
    </div>
</section>

{{-- Project Modal --}}
@include('pages.guest.landing.partials.project-modal', [
    'id' => 'projects-modal',
    'title' => 'Modern Apartment Project',
    'description' => 'A modern apartment complex in Masr Gdeda.',
])
