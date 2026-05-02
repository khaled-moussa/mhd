<div>
    <form
        wire:submit.prevent="submit"
        class="form-layout"
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
            :error="$errors->first('email')"
        />

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
        >
            <div class="show-password">
                <i class="fi fi-tc-eye-crossed"></i>
            </div>
        </x-form.input>

        {{-- Remember + Forgot --}}
        <div class="input-field-row-between">
            <x-form.checkbox label="Remember me" />

            <x-form.link
                label="Forget password"
                :href="route('auth.forgot-password')"
            />
        </div>

        {{-- Form validation --}}
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
</div>
