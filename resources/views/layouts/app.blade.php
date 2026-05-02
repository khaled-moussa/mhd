<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body class="loader">
    <div class="app-shell">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Navbar --}}
        @include('layouts.partials.navbar')

        {{-- Main Content --}}
        <main class="app-content">
            @yield('component')
        </main>

        {{-- Scripts --}}
        @include('layouts.partials.scripts')
    </div>
</body>

</html>
