{{-- Main Layout --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('title', 'Dashboard | Dashboard')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('panels/admin/dashboard/_dashboard.css') }}
    {{ Vite::script('panels/admin/dashboard/_dashboard.js') }}
@endpush

{{-- Content --}}
@section('content')
    <div class="dashboard-grid">
        <div>
            {{-- Page header --}}
            <x-header.page title="Dashboard" />

            {{-- KPI cards section --}}
            @include('admin::dashboard.partials.cards')

            {{-- Project section  --}}
            @include('admin::company-projects.partials.company-project-body')
        </div>
    </div>
@endsection
