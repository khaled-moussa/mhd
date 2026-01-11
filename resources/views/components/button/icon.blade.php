@props([
    'type' => 'button',
    'label' => null,
    'icon' => null,
])

<button
    type="{{ $type }}"
    {{ $attributes->whereStartsWith('id') }}
    {{ $attributes->whereStartsWith('class') }}
    {{ $attributes->whereStartsWith('@click') }}
>
    {{-- Icon --}}
    <i class="{{ $icon }}"></i>

    {{-- Label --}}
    @if ($label)
        <span>
            {{ $label }}
        </span>
    @endif
</button>
