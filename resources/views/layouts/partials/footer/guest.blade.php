<footer
    id="footer"
    class="footer"
>
    <div class="footer-container">

        {{-- Grid --}}
        <div class="footer-grid">

            {{-- Brand --}}
            <div class="footer-brand">
                <x-global.branding />

                <div class="footer-socials">
                    @foreach ($company['data']['socials'] as $social)
                        <x-button.link
                            class="footer-social-link"
                            :href="$social['link']"
                        >
                            <i class="{{ $social['icon'] }}"></i>
                        </x-button.link>
                    @endforeach
                </div>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="footer-col-title">Explore</h4>

                <ul class="footer-list">
                    <li>
                        <x-button.link
                            class="footer-link"
                            label="About"
                            :href="url('/#about')"
                        />
                    </li>
                    <li>
                        <x-button.link
                            class="footer-link"
                            label="Services"
                            :href="url('/#services')"
                        />
                    </li>
                    <li>
                        <x-button.link
                            class="footer-link"
                            label="Projects"
                            :href="url('/#projects')"
                        />
                    </li>
                    <li>
                        <x-button.link
                            class="footer-link"
                            label="Contact"
                            :href="url('/#contact')"
                        />
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="footer-bottom">

            <p class="footer-copy">
                &copy; {{ date('Y') }} MHD. All rights reserved.
            </p>

            <div class="footer-legal">
                <x-button.link
                    class="footer-legal-link"
                    label="Terms of Service"
                />
                <x-button.link
                    class="footer-legal-link"
                    label="Privacy Policy"
                />
            </div>

        </div>

    </div>
</footer>
