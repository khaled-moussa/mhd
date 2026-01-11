@extends('pages.auth.layouts.auth-base')

{{-- Page Header --}}
@section('header', 'Reset Your Password')

{{-- Page Component --}}
@section('auth-component')
    <livewire:auth.reset-password-form-component
        :email="$email"
        :token="$token"
    />
@endsection
