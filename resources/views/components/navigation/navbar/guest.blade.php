<nav id="landing-navbar" class="landing-navbar">
    <div class="landing-navbar-container">
        {{-- Logo --}}
        <a href="#hero" class="branding">
            <x-asset.img folder="branding" img="logo-dark.png" />
        </a>

        {{-- Mobile Toggle --}}
        <div class="landing-navbar-toggle">
            <x-button.main id="landing-toggle-menu-button" class="landing-toggle-button">
                <i class="fi fi-rr-menu-burger"></i>
            </x-button.main>
        </div>
    </div>

    {{-- Navbar Menu --}}
    <ul id="landing-navbar-menu" class="landing-navbar-menu">
        <li>
            <x-button.link label="About Us" path="#about-us" />
        </li>

        <li>
            <x-button.link label="Services" path="#services" />
        </li>

        <li>
            <x-button.link label="Projects" path="#projects" />
        </li>
        
        <li>
            <x-button.link label="Contact" path="#contact-us" />
        </li>
    </ul>
</nav>
