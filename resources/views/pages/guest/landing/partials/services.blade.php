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
                    class="services-card group"
                >
                    {{-- Number --}}
                    <span class="services-card-number">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Icon --}}
                    @if ($service['icon'])
                        <div class="services-icon">
                            {!! $service['icon'] !!}
                        </div>
                    @endif

                    {{-- Content --}}
                    <h3 class="services-title">
                        {{ $service['title'] }}
                    </h3>

                    <p class="services-description">
                        {{ $service['description'] }}
                    </p>

                    <span class="services-link">
                        Learn more
                        <i class="fi fi-rr-arrow-right"></i>
                    </span>
                </div>
            @endforeach
        </div>

    </div>
</section>