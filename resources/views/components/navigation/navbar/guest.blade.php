<nav
    id="landing-navbar"
    class="landing-navbar"
>
    <div class="landing-navbar-container">
        {{-- Logo --}}
        <a
            href="#hero"
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
        <li>
            <x-button.link
                label="About Us"
                :path="$currentRequest ? '#about-us' : url('/#about-us')"
                class="landing-navbar-link"
            />
        </li>
        <li>
            <x-button.link
                label="Services"
                :path="$currentRequest ? '#services' : url('/#services')"
                class="landing-navbar-link"
            />
        </li>
        <li>
            <x-button.link
                label="Projects"
                :path="$currentRequest ? '#projects' : url('/#projects')"
                class="landing-navbar-link"
            />
        </li>
        <li>
            <x-button.link
                label="Contact"
                :path="$currentRequest ? '#contact-us' : url('/#contact-us')"
                class="landing-navbar-link"
            />
        </li>
    </ul>
</nav>
