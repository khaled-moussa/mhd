{{-- Main Layout --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('title', 'Dashboard | Settings')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('shared/settings/_settings.css') }}
    {{ Vite::script('shared/settings/_settings.js') }}
@endpush

{{-- Content --}}
@section('content')
    {{-- Page header --}}
    <x-header.page title="Settings" />

    <div class="settings-grid">
        {{-- Sidebar for settings --}}
        @include('pages.shared.settings.layouts.side-menu')

        {{-- Dynamic tab content (changes via wire:navigate) --}}
        <div class="settings-content">
            @stack('setting-component')
        </div>
    </div>
@endsection
