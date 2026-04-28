<nav id="landing-navbar" class="navbar">

    <input type="checkbox" id="nav-toggle" class="navbar-checkbox" aria-hidden="true" />

    <div class="navbar-container">

        {{-- Brand --}}
        <div class="branding">
            <div class="brand-icon">
                <i class="fi fi-sr-home"></i>
            </div>
            <div class="brand-name">
                MHD
                <span>Development</span>
            </div>
        </div>

        {{-- Desktop Menu --}}
        <ul class="navbar-menu" id="nav-menu" aria-label="Primary">
            <li>
                <x-button.link label="About"    :path="url('#about')"    class="navbar-link" />
            </li>
            <li>
                <x-button.link label="Services" :path="url('#services')" class="navbar-link" />
            </li>
            <li>
                <x-button.link label="Projects" :path="url('#projects')" class="navbar-link" />
            </li>
            <li>
                <x-button.link label="Contact"  :path="url('#contact')"  class="navbar-link" />
            </li>
        </ul>

        {{-- Desktop CTA + Mobile Toggle --}}
        <div class="flex items-center gap-3">
            <a href="#contact" class="navbar-cta">Get in touch</a>

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
    <div class="navbar-mobile-menu" id="nav-menu-mobile">
        <x-button.link label="About"    :path="url('#about')"    class="navbar-mobile-link" />
        <x-button.link label="Services" :path="url('#services')" class="navbar-mobile-link" />
        <x-button.link label="Projects" :path="url('#projects')" class="navbar-mobile-link" />
        <x-button.link label="Contact"  :path="url('#contact')"  class="navbar-mobile-link" />
        <a href="#contact" class="navbar-mobile-cta justify-center">Get in touch</a>
    </div>

</nav>