<section
    id="hero"
    class="hero-section"
>
    <div class="hero-bg">
        <div class="hero-spotlight-top"></div>
        <div class="hero-spotlight-bottom"></div>
    </div>

    <div class="hero-container">

        <div class="hero-flex">
            {{-- Left Side --}}
            <div class="hero-left">
                <div class="hero-badge">
                    <span class="hero-badge-text">Build Dreams</span>
                    <span class="hero-badge-text">Confidence & Innovation</span>
                </div>

                <h1 class="hero-title">
                    <span class="text-gradient">Find Your Dream Property</span>
                </h1>

                <p class="hero-paragraph">
                    Discover modern real estate solutions with cutting-edge architecture and sustainable developments.
                </p>

                <div class="hero-actions">
                    <x-button.link
                        class="main-btn"
                        label="Explore"
                    />

                    <x-button.link
                        class="outline-btn"
                        label="Contact"
                    />
                </div>

                <div class="hero-stats">
                    <div>
                        <h1 id="projects-number"></h1>
                        <p>Projects</p>
                    </div>

                    <div class="hero-divider"></div>

                    <div>
                        <h1 id="customers-number"></h1>
                        <p>Customers</p>
                    </div>

                    <div class="hero-divider"></div>

                    <div>
                        <h1 id="years-of-experiences-number"></h1>
                        <p>Years of Experiences</p>
                    </div>
                </div>
            </div>

            {{-- Right Side --}}
            <div class="hero-right">
                <div
                    class="hero-video"
                    alt=""
                    data-aos="zoom-in"
                >
                    <x-asset.video
                        video="video.mp4"
                        autoplay
                        muted
                        loop
                        playsinline
                    />
                </div>

                {{-- Bottom Card --}}
                <div class="hero-card hero-card-bottom">
                    <div class="hero-card-content">
                        <i class="fi fi-ts-arrow-trend-up"></i>

                        <div>
                            <p>+12.34%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
