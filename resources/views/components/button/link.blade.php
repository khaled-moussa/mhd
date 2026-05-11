@props([
    'label' => null,
    'href' => '#',
])

<a
    href="{{ $href }}"
    id="{{ $attributes->get('id') }}"
    class="{{ $attributes->get('class') }}"
    {{ $attributes->whereStartsWith('data') }}
    {{ $attributes->whereStartsWith('wire') }}
    {{ $attributes->whereStartsWith('x-') }}
    {{ $attributes->whereStartsWith('@click') }}
    {{ $attributes->whereStartsWith('onclick') }}
>
    {{-- Label --}}
    @if ($label)
        {{ $label }}
    @endif

    {{-- Slot (icons, buttons, etc.) --}}
    {{ $slot }}
</a>
