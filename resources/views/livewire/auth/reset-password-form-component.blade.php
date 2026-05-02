<div>
    <form wire:submit.prevent="submit">

        {{-- Password --}}
        <x-form.input
            id="password"
            type="password"
            label="Password"
            placeholder="••••••••"
            wire:model="password"
            autocomplete="current-password"
            required
            :error="$errors->first('password')"
        />

        {{-- Confirm Password --}}
        <x-form.input
            id="password_confirmation"
            type="password"
            label="Confirm Password"
            placeholder="••••••••"
            wire:model="password_confirmation"
            autocomplete="current-password"
            required
            :error="$errors->first('password_confirmation')"
        />

        <x-button.primary
            class="primary-btn-full"
            label="Reset password"
        />
    </form>

    {{-- Divider --}}
    <div class="auth-divider">
        <span>or</span>
    </div>
</div>
