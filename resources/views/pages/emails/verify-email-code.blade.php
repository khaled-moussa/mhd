@extends('layouts.email')

@section('content')

    <div class="header">Hello, {{ $name }} </div>

    <p>
        We received a request to complete your verification for your BRAND account.
    </p>

    <div class="content">
        <div class="sub-header">Your Verification Code</div>

        <p>Use the code below to continue:</p>

        <p class="code">
            {{ $code }}
        </p>
    </div>

    <p>This code will expire shortly for security reasons.</p>

    <p>
        <strong>Note:</strong>
        If you did not request this, you may safely ignore this email.
    </p>

@endsection
