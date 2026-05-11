<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    {{-- Title --}}
    <title>
        @yield('title', config('app.name'))
    </title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts --}}
    <link rel="stylesheet" wire:click="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">

    {{-- Extra --}}
    @stack('head')
</head>

{{-- BODY --}}
<body class="loader">
    @yield('body')

    @stack('script')
</body>

</html>