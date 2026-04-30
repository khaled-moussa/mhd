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
        <x-button.main label="Create Project" :data-custom-open="$modalId['CREATE_COMPANY_PROJECT_MODAL']" />
    </x-header.page>

    <div x-data="projectsComponent" class="projects">
        {{-- Projects table livewire component --}}
        <livewire:panels.admin.company-projects.pages.company-projects-component />

        {{-- View project modal --}}
        @include('admin::company-projects.partials.company-project-view-modal', [
            'modalId' => $modalId['VIEW_COMPANY_PROJECT_MODAL'],
            'modalTitle' => 'View Project',
            'description' => 'View detailed information about the selected project, including its status, timeline, and key data.',
        ])

        {{-- Create project modal --}}
        @include('admin::company-projects.partials.company-project-form-create', [
            'modalId' => $modalId['CREATE_COMPANY_PROJECT_MODAL'],
            'modalTitle' => 'Create Project',
            'description' => 'Fill in the required information to create a new project and assign it to the company workspace.',
        ])

        {{-- Update project modal --}}
        @include('admin::company-projects.partials.company-project-form-update', [
            'modalId' => $modalId['UPDATE_COMPANY_PROJECT_MODAL'],
            'modalTitle' => 'Update Project',
            'description' => 'Modify existing project details such as name, status, timeline, and assigned data.',
        ])
    </div>
@endsection
