@extends('layouts.partials.layout-base')

{{-- Head --}}
@push('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush

{{-- Body --}}
@section('body')
    {{-- Navbar --}}
    @include('layouts.partials.navbar.guest')

    {{-- Main Content --}}
    <main class="content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer.guest')
@endsection

{{-- Script --}}
@push('script')
    <script>
        window.__ENUMS__ = @json($enums ?? []);
    </script>
@endpush
