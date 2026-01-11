@props([
    'type' => 'button',
    'label' => null,
])

<button
    @class([
        'add-btn',
        $attributes->get('class'),
    ])
    type="{{ $type }}"
    id="{{ $attributes->get('id') }}"
    {{ $attributes->whereStartsWith('wire') }}
    {{ $attributes->whereStartsWith('x-model') }}
    {{ $attributes->whereStartsWith('@click') }}
>
    {{-- Label --}}
    {{ $label }}

    {{-- Slot element --}}
    {{ $slot }}
</button>
