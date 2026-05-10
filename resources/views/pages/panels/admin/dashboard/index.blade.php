{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Home')

{{-- Page assets --}}
@push('head')
    {{ Vite::style('panels/admin/dashboard/_dashboard.css') }}
    {{ Vite::script('panels/admin/dashboard/_dashboard.js') }}
@endpush

{{-- Content --}}
@section('component')
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
