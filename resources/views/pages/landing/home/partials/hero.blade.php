@props([
    'section' => [],
])

<section id="hero" class="hero-section">

    {{-- Full-bleed background --}}
    <div class="hero-bg">
        <x-asset.video video="video.mp4" autoplay muted loop playsinline />
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
                    <span class="hero-title-light"> {{ $section['data']['title']['light'] }} </span>
                    <span class="hero-title-main">{{ $section['data']['title']['main'] }}</span>
                    <br>
                    <span class="hero-title-accent">{{ $section['data']['title']['accent'] }}</span>
                </h1>

                <p id="section-description" class="hero-description">
                    {{ $section['description'] }}
                </p>

                <div class="hero-actions">
                    <x-button.link
                        class="primary-btn"
                        label="Explore Projects"
                        href="#projects"
                    />
                    <x-button.link
                        class="outlined-btn white"
                        label="Contact Us"
                        href="#contact"
                    />
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="hero-bar">
        <div class="hero-bar-item">
            <div id="projects-number" class="hero-bar-value">200</div>
            <span class="hero-bar-label">Projects completed</span>
        </div>

        <div class="hero-bar-sep"></div>

        <div class="hero-bar-item">
            <div id="customers-number" class="hero-bar-value">200</div>
            <span class="hero-bar-label">Satisfied customers</span>
        </div>

        <div class="hero-bar-sep"></div>

        <div class="hero-bar-item">
            <div id="years-of-experience-number" class="hero-bar-value">200</div>
            <span class="hero-bar-label">Years of experience</span>
        </div>

        <div class="hero-scroll-hint">
            <div class="hero-scroll-line"></div>
            Scroll to explore
        </div>
    </div>

</section>
