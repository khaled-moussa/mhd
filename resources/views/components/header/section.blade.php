@props([
    'id' => null,
    'label' => null,
    'title' => null,
    'description' => null,
])

<div @class(['section-header', $attributes->get('class')])>

    {{-- Header --}}
    <div>

        @if ($label)
            <span class="section-label">
                {{ $label }}
            </span>
        @endif

        @if ($title)
            <h2 class="section-title">
                {{ $title }}
            </h2>
        @endif

        @if ($description)
            <p class="section-description">
                {{ $description }}
            </p>
        @endif

    </div>

    {{-- Extra --}}
    {{ $slot }}
</div>
