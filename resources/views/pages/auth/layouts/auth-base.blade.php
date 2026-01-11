@extends('layouts.guest')

@section('title', 'Sign In')

@push('head')
    {{ Vite::style('auth/_auth.css') }}
    {{ Vite::script('auth/_auth.js') }}
@endpush

@section('content')
    <main class="auth-wrapper">
        {{-- Auth Content --}}
        <div class="auth-content">
            <div
                class="w-full"
                x-data="authComponent"
                x-cloak
            >
                {{-- Logo --}}
                <div class="logo"></div>

                {{-- Page Header --}}
                <div class="header">
                    <h1>
                        @yield('header')
                    </h1>
                </div>

                {{-- Main Dynamic Component --}}
                @yield('auth-component')
            </div>
        </div>
    </main>
@endsection
