@props([
    'section' => [],
])

<section
    id="services"
    class="services"
>
    <div class="services-container">

        {{-- Header --}}
        <x-header.section
            label="What we offer"
            :title="$section['title']"
        />

        {{-- Grid --}}
        <div class="services-grid">
            @foreach ($section['data'] as $index => $service)
                <div
                    id="{{ $service['uuid'] }}"
                    x-data="{ expanded: false }"
                    class="services-card group"
                >
                    {{-- Number --}}
                    <span class="services-card-number">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Icon --}}
                    @if ($service['icon'])
                        <div class="services-icon">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                    @endif

                    {{-- Content --}}
                    <h3 class="services-title">
                        {{ $service['title'] }}
                    </h3>

                    <p
                        class="services-description"
                        :class="{ 'services-description-expanded': expanded }"
                    >
                        {{ $service['description'] }}
                    </p>

                    <button
                        type="button"
                        @click="expanded = !expanded"
                        class="services-link"
                    >
                        <span x-text="expanded ? 'Show less' : 'Learn more'"></span>

                        <i
                            class="fi fi-rr-arrow-right transition-transform duration-200"
                            :class="{ 'rotate-90': expanded }"
                        ></i>
                    </button>
                </div>
            @endforeach
        </div>

    </div>
</section>
