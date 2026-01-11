@extends('pages.auth.layouts.auth-base')

{{-- Page Header --}}
@section('header', 'Create Your Account')

{{-- Google sign --}}
@section('google-sign', true)

{{-- Page Component --}}
@section('auth-component')
    <livewire:auth.register-form-component />
@endsection
