@props([
    'id' => null,
    'title' => null,
    'paragraph' => null,
])

<div @class(['section-header', $attributes->get('class')])>
    <h2
        id="section-title"
        class="section-title"
    >
        {{ $title }}
    </h2>

    <p
        id="section-description"
        class="section-description"
    >
        {{ $paragraph }}
    </p>
</div>
