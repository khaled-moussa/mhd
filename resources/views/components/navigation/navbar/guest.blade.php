<nav
    id="landing-navbar"
    class="landing-navbar"
>
    <div class="landing-navbar-container">
        {{-- Logo --}}
        <a
            href="{{ $currentRequest ? '#hero' : url('/#hero') }}"
            class="branding"
        >
            <x-asset.img
                folder="branding"
                img="logo-dark.png"
            />
        </a>

        {{-- Mobile Toggle --}}
        <div class="landing-navbar-toggle">
            <x-button.main
                id="landing-toggle-menu-button"
                class="landing-toggle-button"
            >
                <i class="fi fi-rr-menu-burger"></i>
            </x-button.main>
        </div>
    </div>

    {{-- Navbar Menu --}}
    <ul
        id="landing-navbar-menu"
        class="landing-navbar-menu"
    >
        @foreach ($headers as $key => $header)
            @if ($key !== 'footer' || !$header['visible'])
                <li>
                    <x-button.link
                        label="{{ $header['label'] }}"
                        :path="$currentRequest ? $header['url'] : '/' . url($header['url'])"
                        class="landing-navbar-link"
                    />
                </li>
            @endif
        @endforeach
    </ul>
</nav>
