<section id="hero" class="hero">
    <div class="hero-container">
        <div class="hero-content">

            {{-- Left: Main --}}
            <div class="hero-main">

                {{-- Eyebrow --}}
                <div class="hero-badge">
                    <span class="hero-badge-text">Build Dreams</span>
                    <span class="hero-badge-text">Confidence & Innovation</span>
                </div>

                {{-- Title --}}
                <h1 class="hero-title">
                    <span id="section-title" class="text-gradient">
                        {{ $section['title'] }}
                    </span>
                </h1>

                {{-- Description --}}
                <p id="section-description" class="hero-description">
                    {{ $section['description'] }}
                </p>

                {{-- Actions --}}
                <div class="hero-actions">
                    <x-button.link class="main-btn" label="Explore" path="#projects" />
                    <x-button.link class="outline-btn" label="Contact" path="#contact" />
                </div>
            </div>

            {{-- Right: Media --}}
            <div class="hero-media">

                {{-- Top-left card --}}
                <div class="hero-card hero-card-tl">
                    <div class="hero-card-content">
                        <div class="hero-card-icon hero-card-icon-primary">
                            <i class="fi fi-rr-home text-primary text-sm"></i>
                        </div>
                        <div>
                            <p class="hero-card-value">New listing</p>
                            <p class="hero-card-label">Riyadh, Saudi Arabia</p>
                        </div>
                    </div>
                </div>

                {{-- Video --}}
                <div class="hero-video-wrapper" data-aos="zoom-in">
                    <x-asset.video
                        video="video.mp4"
                        autoplay muted loop playsinline
                    />
                </div>

            </div>

        </div>
    </div>
</section>