<div>
    <form wire:submit.prevent="submit">

        {{-- Password --}}
        <x-form.input
            id="password"
            type="password"
            label="Password"
            placeholder="••••••••"
            wire:model="newPassword"
            required
            error="newPassword"
        />

        {{-- Confirm Password --}}
        <x-form.input
            id="password_confirmation"
            type="password"
            label="Confirm Password"
            placeholder="••••••••"
            wire:model="passwordConfirmation"
            required
            error="passwordConfirmation"
        />

        {{-- Failed --}}
        <x-alert.validation-input error="reset_failed" />

        {{-- Submit --}}
        <x-button.primary
            class="primary-btn-full"
            label="Reset password"
            wire:loading.class="spinner"
            wire:target="submit"
            wire:loading.attr="disabled"
        />
    </form>

    {{-- Divider --}}
    <div class="auth-divider">
        <span>or</span>
    </div>
</div>
