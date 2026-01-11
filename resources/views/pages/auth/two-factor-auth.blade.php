@extends('pages.auth.layouts.auth-base')

{{-- Page Header --}}
@section('header', 'Two-Factor Verification')

{{-- Page Component --}}
@section('auth-component')
    <livewire:auth.two-factor-form-component />
@endsection
