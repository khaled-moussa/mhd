{{-- Use Main Layout --}}
@extends('layouts.guest')

{{-- Page Title --}}
@section('title', 'Home')

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
    <div class="landing-content">
        @includeWhen(isset($sections->hero), 'pages.guest.landing.partials.hero', ['section' => $sections->hero])
        @includeWhen(isset($sections->about), 'pages.guest.landing.partials.about', [ 'section' => $sections->about])
        @includeWhen(isset($sections->services), 'pages.guest.landing.partials.services', [ 'section' => $sections->services])
        @includeWhen(isset($sections->projects), 'pages.guest.projects.partials.projects', [ 'section' => $sections->projects])
        @includeWhen(isset($sections->contact), 'pages.guest.landing.partials.contact', [ 'section' => $sections->contact])
    </div>
@endsection

{{-- Footer --}}
@section('footer')
    @include('pages.guest.landing.partials.footer', ['section' => $sections->footer])
@endsection
