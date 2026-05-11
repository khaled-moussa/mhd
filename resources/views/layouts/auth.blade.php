@extends('layouts.partials.layout-base')

{{-- Head --}}
@push('head')
    @vite(['resources/css/app.css', 'resources/css/pages/auth/_auth.css', 'resources/js/app.js'])
@endpush

{{-- Body --}}
@section('body')
    {{-- Main Content --}}
    @yield('content')
@endsection

{{-- Script --}}
@push('script')
    <script>
        window.__ENUMS__ = @json($enums ?? []);
    </script>
@endpush
