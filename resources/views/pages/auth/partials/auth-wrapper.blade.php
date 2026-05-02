<div class="auth-page">

    <div class="auth-form-wrap">
        <x-button.link
            class="outlined-btn sm left"
            label="Back Home"
            :href="route('landing')"
        />

        {{-- Header --}}
        <div class="auth-header">
            <p class="auth-eyebrow">
                @yield('eyebrow')
            </p>

            <h1 class="auth-title">
                @yield('subtitle')
            </h1>

            <p class="auth-subtitle">
                @yield('description')
            </p>
        </div>

        {{-- Form --}}
        @yield('form')
    </div>
</div>
