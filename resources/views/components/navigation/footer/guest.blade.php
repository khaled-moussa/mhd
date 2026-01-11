@props([
    'footer' => [],
])

<footer class="footer">
    <div class="footer-container">
        <div class="footer-grid">

            <!-- Brand Section -->
            <div class="footer-brand">
                <h2 class="footer-logo">
                    <span>Real Estate</span>
                </h2>
                <p class="footer-text">
                    The most trusted real estate company, empowering clients with innovative solutions
                    and top-quality developments.
                </p>
                <div class="footer-socials">
                    @foreach ($footer['data']['socials'] as $social)
                        <a
                            href="{{ $social['link'] }}"
                            class="social-link"
                        >
                            {{ $social['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Company -->
            <div class="footer-col">
                <h3 class="footer-title">Company</h3>
                <ul class="footer-list">
                    @foreach ($footer['data']['company'] as $company)
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
