{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Contacts')

{{-- Page assets --}}
@push('head')
    {{ Vite::style('panels/admin/contacts/_contacts.css') }}
    {{ Vite::script('panels/admin/contacts/_contacts.js') }}
@endpush

{{-- Content --}}
@section('component')
    {{-- Page header --}}
    <x-header.page title="Contacts" />

    <div
        x-data="contactsComponent"
        class="contacts"
    >
        {{-- Contacts table livewire component --}}
        <livewire:panels.admin.contacts.pages.contacts-component />

        {{-- Contacts view modal --}}
        @include('admin::contacts.partials.contact-view-modal', [
            'modalId' => $modalId['VIEW_CONTACT_MODAL'],
            'modalTitle' => 'View Contact Info',
        ])

    </div>
@endsection
