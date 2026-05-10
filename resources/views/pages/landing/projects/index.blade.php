{{-- Main Layout --}}
@extends('pages.landing._layouts.landing-base')

{{-- Page Title --}}
@section('title', 'Projects')

{{-- Content --}}
@section('section')
    @include('pages.landing.projects.partials.projects')
@endsection
