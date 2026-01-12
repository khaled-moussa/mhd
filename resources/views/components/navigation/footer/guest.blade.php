@props([
    'section' => [],
])

<footer
    id="footer"
    class="footer"
>
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Brand Section -->
            <div class="footer-brand">
                {{-- Header Section --}}
                <x-header.section
                    title="{{ $section['title'] }}"
                    paragraph="{{ $section['description'] }}"
                />

                <!-- Socials -->
                <div class="footer-socials">
                    @foreach ($section['data']['socials'] as $social)
                        <x-button.link
                            class="social-link"
                            :path="$social['link']"
                        >
                            <i class="{{ $social['icon'] }}"></i>
                        </x-button.link>
                    @endforeach
                </div>
            </div>

            <!-- Company -->
            <div class="footer-company">
                <h3 class="footer-title">Company</h3>
                <ul class="footer-list">
                    @foreach ($section['data']['company'] as $company)
                        <li>
                            <x-button.link
                                class="footer-link"
                                :label="$company['label']"
                                :path="$company['link']"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <p>&copy; 2025 MHD. All rights reserved.</p>
            <div>
                <x-button.link label="Terms of Service" />
                <x-button.link label="Privacy Policy" />
            </div>
        </div>
    </div>
</footer>
