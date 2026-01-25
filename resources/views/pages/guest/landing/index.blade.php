{{-- Use main layout --}}
@extends('layouts.guest')

{{-- Page title --}}
@section('title', 'Home')

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
        @foreach ($sections as $key => $section)
            @continue($key === 'footer')

            {{-- Default landing section --}}
            @includeIf("pages.guest.landing.partials.$key", compact('section'))

            {{-- Projects section extra rendering --}}
            @if ($key === 'projects')
                @include('pages.guest.projects.partials.projects', [
                    'section' => $section,
                    'perPage' => 6,
                    'showViewAllProjectsBtn' => true,
                ])
            @endif
        @endforeach
    </div>
@endsection

{{-- Footer --}}
@section('footer')
    @if (isset($sections['footer']))
        <x-navigation.footer.guest :section="$sections['footer']" />
    @endif
@endsection
