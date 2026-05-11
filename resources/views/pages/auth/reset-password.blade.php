{{-- Main layout --}}
@extends('layouts.auth')

{{-- Page Title --}}
@section('title', 'Reset Password')

{{-- Auth Form --}}
@section('content')
    <x-form.split-layout
        eyebrow="Reset password"
        subtitle="Choose a new password"
        description="Make sure your new password is strong and secure."
    >
        <x-slot:form>
            @livewire('auth.reset-password-form-component', [
                'email' => $email,
                'token' => $token,
            ])
        </x-slot:form>
    </x-form.split-layout>
@endsection
