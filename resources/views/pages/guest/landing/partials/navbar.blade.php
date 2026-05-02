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

            <x-button.link
                class="primary-btn"
                label="Get in touch"
                :path="url('#contact')"
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

        <x-button.link
            label="Get in touch"
            class="primary-btn"
        />

    </div>
</nav>
