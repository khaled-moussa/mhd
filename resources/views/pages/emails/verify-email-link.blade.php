@extends('layouts.email')

@section('content')
	<div class="header">Hello, {{ $name }} </div>

	<p>
		We received a request to verify your email for your BRAND account.
	</p>

	<div class="content">
		<div class="sub-header">Verify Your Email</div>

		<p>Click the button below to complete the verification:</p>

		<button class="link-btn">
			<a href="{{ $verificationLink }}">
				Verify Email
			</a>
		</button>

		<p class="link">
			If the button above does not work, copy and paste this link into your browser:<br>
			<a href="{{ $verificationLink }}">
				{{ $verificationLink }}
			</a>
		</p>
	</div>

	<p>This verification link will expire shortly for security reasons.</p>

	<p>
		<strong>Note:</strong>
		If you did not request this, please ignore this message.
	</p>
@endsection
