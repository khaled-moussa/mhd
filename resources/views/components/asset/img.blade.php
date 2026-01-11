@props([
    'id' => null,
    'folder' => null,
    'img' => null,
])

<div {{ $attributes->whereStartsWith('class') }}>
	<img
		id="{{ $id }}"
		src="{{ Vite::image("{$folder}/{$img}") }}"
		alt="{{ $img }}"
	>
</div>
