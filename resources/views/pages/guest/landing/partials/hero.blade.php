<section
    id="hero"
    class="hero-section"
>

    {{-- Full-bleed background --}}
    <div class="hero-bg">
        <x-asset.video
            video="video.mp4"
            autoplay
            muted
            loop
            playsinline
        />
    </div>

    {{-- Main content --}}
    <div class="hero-container">
        <div class="hero-inner">

            {{-- Left --}}
            <div class="hero-left">
                <div class="hero-tag">
                    <div class="hero-tag-line"></div>
                    <span class="hero-tag-text">Real Estate · MHD Development</span>
                </div>

                <h1 class="hero-title">
                    <span class="hero-title-light">Find Your</span>
                    Dream<br>
                    <span class="hero-title-accent">Property</span>
                </h1>

                <p class="hero-description">
                    {{ $section['description'] }}
                </p>

                <div class="hero-actions">
                    <x-button.link
                        class="primary-btn"
                        label="Explore Projects"
                        path="#projects"
                    />
                    <x-button.link
                        class="outlined-btn white"
                        label="Contact Us"
                        path="#contact"
                    />
                </div>
            </div>

            {{-- Right: Stats --}}
            <div class="hero-right">
                <div class="hero-stat-card">
                    <div class="hero-stat-accent"></div>
                    <div>
                        <div
                            class="hero-stat-num"
                            id="projects-number"
                        ></div>
                        <div class="hero-stat-label">Projects completed</div>
                    </div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-accent"></div>
                    <div>
                        <div
                            class="hero-stat-num"
                            id="customers-number"
                        ></div>
                        <div class="hero-stat-label">Satisfied customers</div>
                    </div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-accent"></div>
                    <div>
                        <div
                            class="hero-stat-num"
                            id="years-of-experience-number"
                        ></div>
                        <div class="hero-stat-label">Years of experience</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="hero-bar">
        <div class="hero-bar-item">
            <div class="hero-bar-dot hero-bar-dot--amber"></div>
            <span class="hero-bar-value">Riyadh, Saudi Arabia</span>
        </div>

        <div class="hero-bar-sep"></div>

        <div class="hero-bar-item">
            <span class="hero-bar-value">Residential · Commercial</span>
        </div>

        <div class="hero-scroll-hint">
            <div class="hero-scroll-line"></div>
            Scroll to explore
        </div>
    </div>

</section>
