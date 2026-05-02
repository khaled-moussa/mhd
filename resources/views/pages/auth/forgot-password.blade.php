{{-- Use main layout --}}
@extends('pages.auth.layouts.auth-base')

{{-- Page title --}}
@section('title', 'Forgot Password')

{{-- Auth Header --}}
@section('eyebrow', 'Forgot password?')
@section('subtitle', 'Reset your password')
@section('description', 'Enter your email and we’ll send you a reset link.')

{{-- Auth Form --}}
@section('form')
    @livewire('auth.forgot-password-form-component')
@endsection
