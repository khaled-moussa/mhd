@extends('layouts.email')

@section('content')
    <div class="header">Hello, {{ $name }} </div>

    <p>We received a request to confirm your identity using Two-Factor Authentication (2FA) for your BRAND account.</p>

    <div class="content">
        <div class="sub-header">Your Authentication Code</div>

        <p>
            Enter the code below to complete your login and secure your account.
        </p>

        <p class="code">
            Code: {{ $code }}
        </p>
    </div>

    <p>This one-time code will expire shortly for security reasons.</p>

    <p>
        <strong>Note:</strong>
        If you did not attempt to log in or did not request this code, please secure your account immediately.
    </p>
@endsection
