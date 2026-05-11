{{-- Main layout --}}
@extends('layouts.auth')

{{-- Page Title --}}
@section('title', 'Sign In')

{{-- Auth Form --}}
@section('content')
    <x-form.split-layout
        eyebrow="Welcome back"
        subtitle="Sign in to your account"
        description="Enter your credentials to access your account"
    >
        <x-slot:form>
            @livewire('auth.login-form-component')
        </x-slot:form>
    </x-form.split-layout>
@endsection
