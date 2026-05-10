{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Services')

{{-- Page assets --}}
@push('head')
    {{ Vite::style('panels/admin/services/_services.css') }}
    {{ Vite::script('panels/admin/services/_services.js') }}
@endpush

{{-- Content --}}
@section('component')
    {{-- Page header --}}
    <x-header.page title="Services">
        <x-button.primary
            label="Create Service"
            :data-custom-open="$modalId['CREATE_COMPANY_SERVICE_MODAL']"
        />
    </x-header.page>

    @include('admin::company-services.partials.company-service-body')
@endsection
