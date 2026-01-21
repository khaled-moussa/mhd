@extends('pages.auth.layouts.auth-base')

{{-- Page Header --}}
@section('header', 'Welcome Back')

{{-- Page Component --}}
@section('auth-component')
    <livewire:auth.login-form-component />
@endsection
