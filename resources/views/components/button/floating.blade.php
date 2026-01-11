@props([
    'type' => 'button',
    'label' => null,
])

<button
    @class([
        'floating-btn',
        $attributes->get('class'),
    ])
    type="{{ $type }}"
    id="{{ $attributes->get('id') }}"
    {{ $attributes->whereStartsWith('wire') }}
    {{ $attributes->whereStartsWith('x-model') }}
    {{ $attributes->whereStartsWith('@click') }}
>
    {{-- Label --}}
    @if ($label)
        {{ $label }}
    @endif

    {{-- Slot element --}}
    {{ $slot }}
</button>
