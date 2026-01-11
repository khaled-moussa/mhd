{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Home')

{{-- Page assets --}}
@push('head')
    {{ Vite::adminStyle('dashboard/_dashboard.css') }}
    {{ Vite::adminScript('dashboard/_dashboard.js') }}
@endpush

{{-- Content --}}
@section('component')
    {{-- Page header --}}
    <x-header.page title="Dashboard" />

    <div class="dashboard-grid">
        {{-- Left Column --}}
        <div>
            {{-- KPI cards section --}}
            @include('admin::dashboard.partials.cards')

            {{-- Chart section --}}
            @include('admin::dashboard.partials.charts')

            {{-- Users table section --}}
            @include('admin::dashboard.partials.company-services-table')
        </div>

        {{-- Right Column (Overview) --}}
        @include('admin::dashboard.partials.overview')
    </div>
@endsection
