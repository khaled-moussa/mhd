@extends('layouts.email')

@section('content')
    {{-- <img src="https://via.placeholder.com/150" class="logo" alt="Tacktk Logo"> --}}

    <div class="header">Hello, {{ $name }} </div>
    <p>We received a request to reset your password for your TACKTK account.</p>

    <div class="content">
        <div class="sub-header">Reset Your Password</div>
        <p>Click the button below to create a new password.</p>
    </div>

    <button class="link-btn">
        <a href="{{ $resetPasswordLink }}">
            Reset Password
        </a>
    </button>

    <p class="link">
        If the button above does not work, copy and paste this link into your browser:<br>
        <a href="{{ $resetPasswordLink }}">
            {{ $resetPasswordLink }}
        </a>
    </p>

    <br>

    <p>This link will expire in 60 minutes for security reasons.</p>

    <p>
        <strong>Note:</strong>
        If you did not request a password reset, please ignore this email.
    </p>
@endsection
