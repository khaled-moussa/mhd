<nav
    id="landing-navbar"
    class="landing-navbar"
>
    <div class="landing-navbar-container">

        {{-- Logo --}}
        <a
            :href="url('#hero')"
            class="branding"
        >
            <x-asset.img
                folder="branding"
                img="logo-light.png"
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
                label="Hero"
                :path="url('#hero')"
                class="landing-navbar-link"
            />

            <x-button.link
                label="About"
                :path="url('#about')"
                class="landing-navbar-link"
            />

            <x-button.link
                label="Services"
                :path="url('#services')"
                class="landing-navbar-link"
            />

            <x-button.link
                label="Projects"
                :path="url('#projects')"
                class="landing-navbar-link"
            />

            <x-button.link
                label="Contact"
                :path="url('#contact')"
                class="landing-navbar-link"
            />
        </li>
    </ul>
</nav>
