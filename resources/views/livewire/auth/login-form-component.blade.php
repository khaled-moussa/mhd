<form
    id="{{ $formId['LOGIN_FORM'] }}"
    class="form-layout"
    wire:submit.prevent="submit"
>

    {{-- Email --}}
    <x-form.input
        id="email"
        type="email"
        label="Email address"
        placeholder="you@example.com"
        wire:model="email"
        autocomplete="email"
        required
        error="email"
    />

    {{-- Password --}}
    <x-form.password
        id="password"
        wire:model="password"
        error="password"
    />

    {{-- Remember + Forgot --}}
    <div class="input-field-row-between">
        <x-form.checkbox
            label="Remember me"
            wire:model="remember"
            error="remember"
        />

        <x-form.link
            label="Forget password"
            :href="route('auth.forgot-password')"
        />
    </div>

    {{-- Failed --}}
    <x-alert.validation-input error="login_failed" />

    {{-- Submit --}}
    <x-button.primary
        class="primary-btn-full"
        label="Login"
        wire:loading.class="spinner"
        wire:target="submit"
        wire:loading.attr="disabled"
    />
</form>
