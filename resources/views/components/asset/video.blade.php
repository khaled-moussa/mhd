@props([
    'id' => null,
    'folder' => null,
    'video' => null,
])

<video id="{{ $id }}" src="{{ Vite::video("{$folder}/{$video}") }}" {{ $attributes->merge(['class' => '']) }}>
