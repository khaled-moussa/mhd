@props([
    'type' => 'button',
])

<button
	@class(['dropdown-btn', $attributes->get('class')])
	type="{{ $type }}"
	id="{{ $attributes->get('id') }}"
	{{ $attributes->whereStartsWith('data-dropdown-toggle') }}
	{{ $attributes->whereStartsWith('wire') }}
	{{ $attributes->whereStartsWith('x-model') }}
	{{ $attributes->whereStartsWith('@click') }}
>
	{{-- Slot element --}}
	{{ $slot }}
</button>
