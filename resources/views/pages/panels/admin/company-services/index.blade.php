{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Services')

{{-- Page assets --}}
@push('head')
    {{ Vite::adminStyle('services/_services.css') }}
    {{ Vite::adminScript('services/_services.js') }}
@endpush

{{-- Content --}}
@section('component')
    {{-- Page header --}}
    <x-header.page title="Services">
        <x-button.main
            label="Create Service"
            :data-custom-open="$modal['CREATE_COMPANY_SERVICE_MODAL']"
        />
    </x-header.page>

    <div
        x-data="companyServicesComponent"
        class="services"
    >
        {{-- Services table livewire component --}}
        <livewire:panels.admin.company-services.pages.company-services-component />

        {{-- Create service modal --}}
        @include('admin::company-services.partials.company-service-form-create', [
            'modalId' => $modal['CREATE_COMPANY_SERVICE_MODAL'],
            'modalTitle' => 'Create Service',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
        ])

        {{-- Update service modal --}}
        @include('admin::company-services.partials.company-service-form-update', [
            'modalId' => $modal['UPDATE_COMPANY_SERVICE_MODAL'],
            'modalTitle' => 'Update Service',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
        ])
    </div>
@endsection
