@extends('layouts.email')

@section('content')
    {{-- <img src="https://via.placeholder.com/150" class="logo" alt="Tacktk Logo"> --}}

    <div class="header">Hello, {{ $name }} </div>

    <p>We received a request to delete your TACKTK account.</p>

    <div class="content">
        <div class="sub-header">Verify Account Deletion</div>

        <p>
            To confirm this action and protect your account, please use the verification code below:
        </p>

        <p class="code">
            Code: {{ $code }}
        </p>
    </div>

    <p>
        This verification code will expire shortly for security reasons.
    </p>

    <p>
        <strong>Note:</strong>
        If you did not request to delete your account, please ignore this email.
    </p>
@endsection
