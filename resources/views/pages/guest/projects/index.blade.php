{{-- Use Main Layout --}}
@extends('layouts.guest')

{{-- Page Title --}}
@section('title', 'Projects')

{{-- Page Assets --}}
@push('head')
    {{ Vite::landingStyle('landing/_landing.css') }}
    {{ Vite::landingScript('landing/_landing.js') }}
@endpush

{{-- Navbar --}}
@section('navbar')
    @include('pages.guest.landing.partials.navbar')
@endsection

{{-- Content --}}
@section('content')
    @includeWhen(isset($sections->projects), 'pages.guest.projects.partials.projects',  [ 'section' => $sections->projects])
@endsection

{{-- Footer --}}
@section('footer')
    @include('pages.guest.landing.partials.footer', ['section' => $sections->footer])
@endsection
