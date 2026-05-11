@extends('layouts.partials.layout-base')

{{-- Head --}}
@push('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush

{{-- Body --}}
@section('body')
    <div class="under-dev-page">
        {{-- Optional pulse --}}
        @hasSection('pulse')
            <span class="under-dev-pulse">
                <span class="dot"></span>
                <span class="dot-shadow"></span>
            </span>
        @endif

        {{-- Page title --}}
        <div class="under-dev-header">
            <h1 class="under-dev-code">@yield('code')</h1>
            <h1 class="under-dev-title">@yield('title')</h1>
        </div>

        {{-- Page message --}}
        <p class="under-dev-subtitle">@yield('message')</p>

        {{-- Optional button --}}
        @hasSection('button')
            <p class="under-dev-button">
                <x-button.link class="outlined-btn" label="Go Home" :href="url('/')" />
            </p>
        @endif
    </div>
@endsection

{{-- Script --}}
@push('script')
    <script>
        window.__ENUMS__ = @json($enums ?? []);
        window.__USER__ = @json($currentUser ?? null);
    </script>
@endpush