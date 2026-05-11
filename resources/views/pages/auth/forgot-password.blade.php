{{-- Main layout --}}
@extends('layouts.auth')

{{-- Page Title --}}
@section('title', 'Forgot Password')

{{-- Auth Form --}}
@section('content')
    <x-form.split-layout
        eyebrow="Forgot password?"
        subtitle="Reset your password"
        description="Enter your email and we’ll send you a reset link."
    >
        <x-slot:form>
            @livewire('auth.forgot-password-form-component')
        </x-slot:form>
    </x-form.split-layout>
@endsection
