<nav
    id="landing-navbar"
    class="navbar"
>
    <input
        type="checkbox"
        id="nav-toggle"
        class="navbar-checkbox"
        aria-hidden="true"
    >

    <div class="navbar-container">

        {{-- Brand --}}
        <x-global.branding />

        {{-- Desktop --}}
        <div class="navbar-menu">

            <ul class="navbar-links">
                <li>
                    <x-button.link
                        label="About"
                        :path="url('#about')"
                        class="navbar-link"
                    />
                </li>

                <li>
                    <x-button.link
                        label="Services"
                        :path="url('#services')"
                        class="navbar-link"
                    />
                </li>

                <li>
                    <x-button.link
                        label="Projects"
                        :path="url('#projects')"
                        class="navbar-link"
                    />
                </li>

                <li>
                    <x-button.link
                        label="Contact"
                        :path="url('#contact')"
                        class="navbar-link"
                    />
                </li>
            </ul>

            <x-button.link
                class="primary-btn"
                label="Get in touch"
                path="#contact"
            />
        </div>

        {{-- Mobile Toggle --}}
        <label
            for="nav-toggle"
            class="navbar-toggle"
            aria-label="Toggle navigation"
        >
            <span></span>
            <span></span>
            <span></span>
        </label>

    </div>

    {{-- Mobile Menu --}}
    <div class="navbar-mobile-menu">

        <x-button.link
            label="About"
            :path="url('#about')"
            class="navbar-mobile-link"
        />

        <x-button.link
            label="Services"
            :path="url('#services')"
            class="navbar-mobile-link"
        />

        <x-button.link
            label="Projects"
            :path="url('#projects')"
            class="navbar-mobile-link"
        />

        <x-button.link
            label="Contact"
            :path="url('#contact')"
            class="navbar-mobile-link"
        />

        <a
            href="#contact"
            class="navbar-mobile-cta"
        >
            Get in touch
        </a>

    </div>
</nav>
