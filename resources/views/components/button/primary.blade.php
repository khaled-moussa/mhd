@props([
    'type' => 'submit',
    'label' => null,
    'disabled' => false,
])

<button
    type="{{ $type }}"
    id="{{ $attributes->get('id') }}"
  
    {{-- Core Attributes --}}
    id="{{ $attributes->get('id') }}"
    @class(['primary-btn', $attributes->get('class')])

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