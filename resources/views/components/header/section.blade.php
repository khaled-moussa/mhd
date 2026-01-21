@props([
    'id' => null,
    'title' => null,
    'description' => null,
])

<div @class(['section-header', $attributes->get('class')])>

    @if ($title)
        <h2
            id="section-title"
            class="section-title"
        >
            {{ $title }}
        </h2>
    @endif

    @if ($description)
        <p
            id="section-description"
            class="section-description"
        >
            {{ $description }}
        </p>
    @endif
</div>
