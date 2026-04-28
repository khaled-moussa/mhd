@props([
    'section' => [],
])

<section id="services" class="services">
    <div class="services__container">

        {{-- Header --}}
        <div class="services__header">
            <span class="section-label">What we offer</span>
            <h2>{{ $section['title'] }}</h2>
            <p>{{ $section['description'] }}</p>
        </div>

        {{-- Services Grid --}}
        <div class="services__grid">
            @foreach ($section['data'] as $index => $service)
                <div class="services__card group" id="{{ $service['uuid'] }}">
                    <span class="services__card-number">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    @if ($service['icon'])
                        <div class="services__icon">
                            {!! $service['icon'] !!}
                        </div>
                    @endif

                    <h3 class="service-data__title">{{ $service['title'] }}</h3>
                    <p class="service-data__description">{{ $service['description'] }}</p>

                    <span class="service-data__link">
                        Learn more
                        <i class="fi fi-rr-arrow-right"></i>
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>