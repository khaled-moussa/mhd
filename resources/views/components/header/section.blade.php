@props([
    'title' => null,
    'paragraph' => null,
])

<div class="section-header">
    <h2 class="section-title">
        {{ $title }}
    </h2>
    <p class="section-paragraph">
        {{ $paragraph }}
    </p>
</div>
