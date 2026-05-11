{{-- Main Layout --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('title', 'Dashboard | Services')

{{-- Page Assets --}}
@push('head')
    {{ Vite::style('panels/admin/services/_services.css') }}
    {{ Vite::script('panels/admin/services/_services.js') }}
@endpush

{{-- Content --}}
@section('content')
    {{-- Page header --}}
    <x-header.page title="Services">
        <x-button.primary
            label="Create Service"
            :data-custom-open="$modalId['CREATE_COMPANY_SERVICE_MODAL']"
        />
    </x-header.page>

    @include('admin::company-services.partials.company-service-body')
@endsection
