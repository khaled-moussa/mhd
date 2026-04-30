{{-- Main Layout --}}
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

    @includeWhen(
        property_exists($sections, 'hero'),
        'pages.guest.landing.partials.hero',
        ['section' => data_get($sections, 'hero')]
    )

    @includeWhen(
        property_exists($sections, 'about'),
        'pages.guest.landing.partials.about',
        ['section' => data_get($sections, 'about')]
    )

    @includeWhen(
        property_exists($sections, 'services'),
        'pages.guest.landing.partials.services',
        ['section' => data_get($sections, 'services')]
    )

    @includeWhen(
        property_exists($sections, 'projects'),
        'pages.guest.projects.partials.projects',
        ['projects' => data_get($sections, 'projects')]
    )

    @includeWhen(
        property_exists($sections, 'contact'),
        'pages.guest.landing.partials.contact',
        ['section' => data_get($sections, 'contact')]
    )


@endsection

{{-- Footer --}}
@section('footer')
    @includeWhen(
        property_exists($sections, 'footer'),
        'pages.guest.landing.partials.footer',
        ['section' => data_get($sections, 'footer')]
    )
@endsection