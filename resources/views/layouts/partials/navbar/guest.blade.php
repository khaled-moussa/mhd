<nav
    id="landing-navbar"
    class="navbar--guest"
>

    <input
        type="checkbox"
        id="nav-toggle"
        class="navbar-checkbox"
        aria-hidden="true"
    />

    <div class="navbar-container">

        {{-- Brand --}}
        <x-global.branding />

        {{-- Desktop Menu --}}
        <ul
            class="navbar-menu"
            id="nav-menu"
            aria-label="Primary"
        >
            <li>
                <x-button.link
                    class="navbar-link"
                    label="About"
                    :path="url('#about')"
                />
            </li>
            <li>
                <x-button.link
                    class="navbar-link"
                    label="Services"
                    :path="url('#services')"
                />
            </li>
            <li>
                <x-button.link
                    class="navbar-link"
                    label="Projects"
                    :path="url('#projects')"
                />
            </li>
            <li>
                <x-button.link
                    class="navbar-link"
                    label="Contact"
                    :path="url('#contact')"
                />
            </li>
        </ul>

        {{-- Desktop CTA + Mobile Toggle --}}
        <div class="flex items-center gap-3">

            <x-button.link
                class="primary-btn white"
                label="Get in touch"
                :path="url('#contact')"
            />

            <label
                class="navbar-toggle"
                for="nav-toggle"
                aria-label="Toggle navigation"
                aria-controls="nav-menu"
            >
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

    </div>

    {{-- Mobile Dropdown --}}
    <div
        class="navbar-mobile-menu"
        id="nav-menu-mobile"
    >
        <x-button.link
            class="navbar-mobile-link"
            label="About"
            :path="url('#about')"
        />
        <x-button.link
            class="navbar-mobile-link"
            label="Services"
            :path="url('#services')"
        />
        <x-button.link
            class="navbar-mobile-link"
            label="Projects"
            :path="url('#projects')"
        />
        <x-button.link
            class="navbar-mobile-link"
            label="Contact"
            :path="url('#contact')"
        />

        <x-button.outlined label="Get in touch" />
    </div>
</nav>
