@extends('layouts.partials.layout-base')

{{-- Head --}}
@push('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
@endpush

{{-- Body --}}
@section('body')
    <div class="app-shell">
        {{-- Sidebar --}}
        @include('layouts.partials.sidebar.app')

        {{-- Navbar --}}
        @include('layouts.partials.navbar.app')

        {{-- Main Content --}}
        <main class="app-content">
            @yield('content')
        </main>
    </div>
@endsection

{{-- Body class --}}
@push('body-class', 'loader')

{{-- Script --}}
@push('script')
    @livewireScripts

    <script>
        window.__ENUMS__ = @json($enums ?? []);
        window.__USER__ = @json($currentUser ?? null);
    </script>
@endpush
