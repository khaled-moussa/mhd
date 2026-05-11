@props([
    'href'  => '#',
    'label' => null,
])

<div
    @class([
        'input-field-link',
        $attributes->get('class'),
    ])
>

    <a
        href="{{ $href }}"

        {{-- Livewire / Alpine / Events --}}
        {{ $attributes->whereStartsWith('wire') }}
        {{ $attributes->whereStartsWith('x-') }}
        {{ $attributes->whereStartsWith('@') }}
    >
        {{ $label ?? $slot }}
    </a>

</div>