<nav
    id="navbar-guest"
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
                    :href="url('#about')"
                />
            </li>
            <li>
                <x-button.link
                    class="navbar-link"
                    label="Services"
                    :href="url('#services')"
                />
            </li>
            <li>
                <x-button.link
                    class="navbar-link"
                    label="Projects"
                    :href="url('#projects')"
                />
            </li>
            <li>
                <x-button.link
                    class="navbar-link"
                    label="Contact"
                    :href="url('#contact')"
                />
            </li>
        </ul>

    </div>

    {{-- Desktop CTA + Mobile Toggle --}}
    <div class="navbar-actions">
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
    
    {{-- Mobile Dropdown --}}
    <div
        class="navbar-mobile-menu"
        id="nav-menu-mobile"
    >
        <x-button.link class="navbar-mobile-link" label="About"    :href="url('#about')"    onclick="navLinkMobile()"/>
        <x-button.link class="navbar-mobile-link" label="Services" :href="url('#services')" onclick="navLinkMobile()"/>
        <x-button.link class="navbar-mobile-link" label="Projects" :href="url('#projects')" onclick="navLinkMobile()"/>
        <x-button.link class="navbar-mobile-link" label="Contact"  :href="url('#contact')"  onclick="navLinkMobile()"/>
    </div>
</nav>