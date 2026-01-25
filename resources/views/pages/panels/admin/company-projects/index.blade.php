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
        <x-button.main
            label="Create Project"
            :data-custom-open="$modal['CREATE_COMPANY_PROJECT_MODAL']"
        />
    </x-header.page>

    <div
        x-data="projectsComponent"
        class="projects"
    >
        {{-- Projects table livewire component --}}
        <livewire:panels.admin.company-projects.pages.company-projects-component />

        {{-- View project modal --}}
        @include('admin::company-projects.partials.company-project-view-modal', [
            'modalId' => $modal['VIEW_COMPANY_PROJECT_MODAL'],
            'modalTitle' => 'View Project',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
        ])

        {{-- Create project modal --}}
        @include('admin::company-projects.partials.company-project-form-create', [
            'modalId' => $modal['CREATE_COMPANY_PROJECT_MODAL'],
            'modalTitle' => 'Create Project',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
        ])

        {{-- Update project modal --}}
        @include('admin::company-projects.partials.company-project-form-update', [
            'modalId' => $modal['UPDATE_COMPANY_PROJECT_MODAL'],
            'modalTitle' => 'Update Project',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
        ])
    </div>
@endsection
