@props([
    'type' => 'button',
    'label' => null,
    'disabled' => false,
])

<button
    type="{{ $type }}"

    {{-- Core Attributes --}}
    id="{{ $attributes->get('id') }}"
    @class(['', $attributes->get('class')])

	{{-- JS / Alpine / Livewire --}}
    {{ $attributes->whereStartsWith('data') }}
    {{ $attributes->whereStartsWith('wire') }}
    {{ $attributes->whereStartsWith('x-') }}
    {{ $attributes->whereStartsWith('@click') }}
    {{ $attributes->whereStartsWith('onclick') }}
    
    @disabled($disabled)
>
    {{-- Label --}}
    @if ($label)
        {{ $label }}
    @endif

	{{-- Slot (icons, buttons, etc.) --}}
    {{ $slot }}
</button>


