@extends('pages.shared.settings.layouts.settings-base')

@push('setting-component')
    {{-- Secuirty livewire component --}}
    <livewire:shared.settings.pages.security-component />
@endpush

{{-- Update email form modal --}}
@push('setting-component')
    @include('pages.shared.settings.security.partials.email-form-update-modal', [
        'modalId' => $modal['UPDATE_EMAIL_MODAL'],
        'modalTitle' => 'Change email address',
        'description' =>
            'Enter a new email address for your account. You will receive a verification email to your current email address with a link to finalize the change.',
    ])
@endpush

{{-- Update password form modal --}}
@push('setting-component')
    @include('pages.shared.settings.security.partials.password-form-update-modal', [
        'modalId' => $modal['UPDATE_PASSWORD_MODAL'],
        'modalTitle' => 'Change password',
        'description' => 'Enter a new password for your account.',
    ])
@endpush

{{-- Update two factor form modal --}}
@push('setting-component')
    @include('pages.shared.settings.security.partials.two-factor-form-update-modal', [
        'modalId' => $modal['UPDATE_TWO_FACTOR_MODAL'],
        'modalTitle' => 'Turn on 2-Step Verification',
        'description' => 'Prevent hackers from accessing your account with an additional layer of security.',
    ])
@endpush

{{-- Delete account form modal --}}
@push('setting-component')
    @include('pages.shared.settings.security.partials.account-form-delete-modal', [
        'modalId' => $modal['DELETE_ACCOUNT_MODAL'],
        'modalTitle' => 'Delete account',
    ])
@endpush
