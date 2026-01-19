{{-- Use main layout --}}
@extends('layouts.guest')

{{-- Page title --}}
@section('title', 'NAME OF TAB')

{{-- Page assets --}}
@push('head')
    @vite(['resources/css/pages/guest/landing/_landing.css', 'resources/js/pages/guest/landing/_landing.js'])
@endpush

{{-- Navbar --}}
@section('navbar')
    <x-navigation.navbar.guest />
@endsection

{{-- Content --}}
@section('content')
    <div class="landing-content">
        @include('pages.guest.projects.partials.projects', [
            'section' => $sections['projects'],
        ])
    </div>
@endsection

{{-- Footer --}}
@section('footer')
    @if (isset($sections['footer']))
        <x-navigation.footer.guest :section="$sections['footer']" />
    @endif
@endsection
