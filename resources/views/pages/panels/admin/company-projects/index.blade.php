{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Projects')

{{-- Page assets --}}
@push('head')
    {{ Vite::adminStyle('projects/_projects.css') }}
    {{ Vite::adminScript('projects/_projects.js') }}
@endpush

{{-- Content --}}
@section('component')
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
