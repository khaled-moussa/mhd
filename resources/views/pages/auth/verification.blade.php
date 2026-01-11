@extends('pages.auth.layouts.auth-base')

{{-- Page Component --}}
@section('auth-component')
    <div
        id="verify-section"
        class="verify-section"
    >
        <iframe src="https://lottie.host/embed/c3d3a80e-7896-41bd-b338-7c489d2ef62c/V2PZQYtYe5.lottie"></iframe>

        <p class="description">
            Before proceeding, please check your email for a verification link.
        </p>

        @if (session('verify_email_status'))
            <p class="description badge {{ session('verify_email_status.type') }}">
                {{ session('verify_email_status.message') }}
            </p>
        @endif

        <div class="form-actions">
            {{-- Resend verification link --}}
            <form
                method="POST"
                action="{{ route('auth.verification.send') }}"
                class="!mt-0"
            >
                @csrf
                <x-button.main
                    class="!mx-auto"
                    type="submit"
                    label="Resend Verification Email"
                />
            </form>

            {{-- Logout / switch account --}}
            <form
                action="{{ route('auth.logout') }}"
                method="POST"
                class="!mt-0 -translate-y-4"
            >
                @csrf
                <x-button.outline
                    class="!mx-auto !p-3"
                    type="submit"
                    label="Login with another account"
                />
            </form>
        </div>
    </div>
@endsection
