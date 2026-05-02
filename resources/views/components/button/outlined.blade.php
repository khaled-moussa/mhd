@props([
    'type' => 'button',
    'label' => null,
    'disabled' => false,
])

<button
    type="{{ $type }}"

    {{-- Core Attributes --}}
    id="{{ $attributes->get('id') }}"
    @class(['outlined-btn', $attributes->get('class')])

	{{-- JS / Alpine / Livewire --}}
    {{ $attributes->whereStartsWith('data') }}
    {{ $attributes->whereStartsWith('wire') }}
    {{ $attributes->whereStartsWith('x-') }}
    {{ $attributes->whereStartsWith('@click') }}
    @disabled($disabled)
>
    {{-- Label --}}
    @if ($label)
        {{ $label }}
    @endif

	{{-- Slot (icons, buttons, etc.) --}}
    {{ $slot }}
</button>


