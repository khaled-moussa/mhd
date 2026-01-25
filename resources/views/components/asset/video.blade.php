@props([
    'id' => null,
    'folder' => null,
    'video' => null,
])

<div {{ $attributes->whereStartsWith('class') }}>
    <video
        id="{{ $id }}"
        src="{{ Vite::video("{$folder}/{$video}") }}"
        {{ $attributes->whereStartsWith('autoplay') }}
        {{ $attributes->whereStartsWith('muted') }}
        {{ $attributes->whereStartsWith('loop') }}
        {{ $attributes->whereStartsWith('playsinline') }}
    >
</div>
