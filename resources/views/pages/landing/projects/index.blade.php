{{-- Main Layout --}}
@extends('layouts.guest')

{{-- Page Title --}}
@section('title', 'Projects')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('landing/_landing.css') }}
    {{ Vite::script('landing/_landing.js') }}
@endpush

{{-- Content --}}
@section('content')
     @include('pages.landing.projects.partials.projects')
@endsection