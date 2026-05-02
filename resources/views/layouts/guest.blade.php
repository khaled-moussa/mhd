<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body>
    {{-- Navbar --}}
    @yield('navbar')

    {{-- Main Content --}}
    <main class="content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @yield('footer')

    {{-- Scripts --}}
    @include('layouts.partials.scripts')
</body>

</html>
