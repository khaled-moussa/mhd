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
    <div class="dashboard-grid">
        <div>
            {{-- Page header --}}
            <x-header.page title="Dashboard" />

            {{-- KPI cards section --}}
            @include('admin::dashboard.partials.cards')

            {{-- Users table section --}}
            @include('admin::dashboard.partials.company-projects-table')
        </div>
    </div>
@endsection
