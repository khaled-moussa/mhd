{{-- Use main layout --}}
@extends('pages.auth.layouts.auth-base')

{{-- Page title --}}
@section('title', 'Sign In')

{{-- Auth Header --}}
@section('eyebrow', 'Welcome back')
@section('subtitle', 'Sign in to your account')
@section('description', 'Enter your credentials to access your account')

{{-- Auth Form --}}
@section('form')
    @livewire('auth.login-form-component')
@endsection
