<footer
    id="footer"
    class="footer"
>
    <div class="footer-container">
        <div class="footer-grid">

            {{-- Brand --}}
            <div class="footer-brand">

                <div class="branding">
                    <div class="brand-icon">
                        <i class="fi fi-sr-home"></i>
                    </div>
                    <div class="brand-name">
                        MHD
                        <span>Development</span>
                    </div>
                </div>

                <p class="brand-desc">
                    {{ $section['description'] }}
                </p>

                <div class="footer-socials">
                    @foreach ($section['data']['socials'] as $social)
                        <x-button.link
                            class="footer-social-link"
                            :path="$social['link']"
                        >
                            <i class="{{ $social['icon'] }}"></i>
                        </x-button.link>
                    @endforeach
                </div>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="footer-col-title">Company</h4>

                <ul class="footer-list">
                    @foreach ($section['data']['company'] as $item)
                        <li>
                            <x-button.link
                                class="footer-link"
                                :label="$item['label']"
                                :path="$item['link']"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Social Links --}}
            <div>
                <h4 class="footer-col-title">Follow us</h4>

                <ul class="footer-list">
                    @foreach ($section['data']['socials'] as $social)
                        <li>
                            <x-button.link
                                class="footer-link"
                                :label="$social['label']"
                                :path="$social['link']"
                            />
                        </li>
                    @endforeach
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
