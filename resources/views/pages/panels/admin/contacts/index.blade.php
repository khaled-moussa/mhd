{{-- Use main layout --}}
@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Dashboard | Contacts')

{{-- Page assets --}}
@push('head')
    {{ Vite::adminStyle('contacts/_contacts.css') }}
    {{ Vite::adminScript('contacts/_contacts.js') }}
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
    </div>
@endsection
