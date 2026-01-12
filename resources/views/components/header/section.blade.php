@props([
    'title' => null,
    'paragraph' => null,
])

<div @class(['section-header', $attributes->get('class')])>
    <h2 class="section-title">
        {{ $title }}
    </h2>
    <p class="section-description">
        {{ $paragraph }}
    </p>
</div>
