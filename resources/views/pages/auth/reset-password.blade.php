{{-- Use main layout --}}
@extends('pages.auth.layouts.auth-base')

{{-- Page title --}}
@section('title', 'Reset Password')

{{-- Auth Header --}}
@section('eyebrow', 'Reset password')
@section('subtitle', 'Choose a new password')
@section('description', 'Make sure your new password is strong and secure.')

{{-- Auth Form --}}
@section('form')
    @livewire('auth.reset-password-form-component', [
        'email' => $email,
        'token' => $token,
    ])
@endsection
