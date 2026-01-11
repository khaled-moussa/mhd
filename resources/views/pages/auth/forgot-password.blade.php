@extends('pages.auth.layouts.auth-base')

{{-- Page Header --}}
@section('header', 'Forgot Password')

{{-- Page Component --}}
@section('auth-component')
    <livewire:auth.forgot-password-form-component />
@endsection
