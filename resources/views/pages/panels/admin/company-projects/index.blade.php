{{-- Main Layout --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('title', 'Dashboard | Projects')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('panels/admin/projects/_projects.css') }}
    {{ Vite::script('panels/admin/projects/_projects.js') }}
@endpush

{{-- Content --}}
@section('content')
    {{-- Page header --}}  
    <x-header.page title="Projects">
        <x-button.primary
            label="Create Project"
            :data-custom-open="$modalId['CREATE_COMPANY_PROJECT_MODAL']"
        />
    </x-header.page>

    {{-- Project body  --}}
    @include('admin::company-projects.partials.company-project-body')
@endsection
