{{-- Main Layout --}}
@extends('layouts.guest')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('landing/_landing.css') }}
    {{ Vite::script('landing/_landing.js') }}
@endpush

{{-- Navbar --}}
@section('navbar')
    @include('layouts.partials.navbar.guest')
@endsection

{{-- Content --}}
@section('content')
    @yield('section')
@endsection

{{-- Footer --}}
@section('footer')
    @include('layouts.partials.footer.guest')
@endsection
