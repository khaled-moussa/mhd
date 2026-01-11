@props([
    'section' => [],
])

<section id="services" class="services-section">
    <div class="services-container">

        {{-- Header Section --}}
        <x-header.section title="Our Real Estate Services"
            paragraph="We provide professional real estate solutions to help you find, manage, and grow your investments with confidence." />

        {{-- Services Grid --}}
        <div class="services-grid">
            @foreach ($section['data'] as $service)
                <div class="service-card group" id="{{ $service['uuid'] }}">
                    <div class="service-icon">
                        <i class="{{ $service['icon'] }}"></i>
                    </div>

                    <h3 class="service-title">
                        {{ $service['title'] }}
                    </h3>

                    <p class="service-desc">
                        {{ $service['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
