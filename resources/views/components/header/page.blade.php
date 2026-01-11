@props(['title'])


<header
    @class([
        'page-header',
        $attributes->get('class'),
    ])
>
    {{-- Label --}}
    {{ $title }}

    {{-- Slot element --}}
    {{ $slot }}
</header>
