<div>
    <form wire:submit.prevent="submit">

        {{-- Email --}}
        <x-form.input
            id="email"
            type="email"
            label="Email address"
            placeholder="you@example.com"
            wire:model="email"
            autocomplete="email"
            required
            :error="$errors->first('email')"
        />

        <x-button.primary
            class="primary-btn-full"
            label="Forgot password"
        />
    </form>

    {{-- Divider --}}
    <div class="auth-divider">
        <span>or</span>
    </div>
</div>
