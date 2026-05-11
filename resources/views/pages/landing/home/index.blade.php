{{-- Main Layout --}}
@extends('layouts.guest')

{{-- Page Title --}}
@section('title', 'Home')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('landing/_landing.css') }}
    {{ Vite::script('landing/_landing.js') }}
@endpush

{{-- Content --}}
@section('content')
    @includeWhen(
        property_exists($sections, 'hero'),
        'pages.landing.home.partials.hero',
        ['section' => data_get($sections, 'hero')]
    )

    @includeWhen(
        property_exists($sections, 'about'),
        'pages.landing.home.partials.about',
        ['section' => data_get($sections, 'about')]
    )

    @includeWhen(
        property_exists($sections, 'services'),
        'pages.landing.home.partials.services',
        ['section' => data_get($sections, 'services')]
    )

    @includeWhen(
        property_exists($sections, 'projects'),
        'pages.landing.home.partials.projects',
        ['section' => data_get($sections, 'projects')]
    )

    @includeWhen(
        property_exists($sections, 'contact'),
        'pages.landing.home.partials.contact',
        ['section' => data_get($sections, 'contact')]
    )
@endsection