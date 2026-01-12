@props([
    'section' => [],
])

<section id="services" class="services">
    <div class="services__container">

        {{-- Header Section --}}
        <x-header.section
            title="{{ $section['title'] }}"
            paragraph="{{ $section['description'] }}"
        />

        {{-- Services Grid --}}
        <div class="services__grid">
            @foreach ($section['data'] as $service)
                <div class="services__card group" id="{{ $service['uuid'] }}">
                    <div class="services__icon">
                        <i class="{{ $service['icon'] }}"></i>
                    </div>

                    <h3 class="service-data__title">
                        {{ $service['title'] }}
                    </h3>

                    <p class="service-data__description">
                        {{ $service['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
