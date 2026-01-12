@props([
    'section' => [],
])

<section
    id="hero"
    class="hero"
>
    <div class="hero__bg">
        <div class="hero__spotlight hero__spotlight--top"></div>
        <div class="hero__spotlight hero__spotlight--bottom"></div>
    </div>

    <div class="hero__container">

        <div class="hero__content">
            {{-- Left Side --}}
            <div class="hero__main">
                <div class="hero__badge">
                    <span class="hero__badge-text">Build Dreams</span>
                    <span class="hero__badge-text">Confidence & Innovation</span>
                </div>

                <h1 class="hero__title">
                    <span class="text-gradient">
                        {{ $section['title'] }}
                    </span>
                </h1>

                <p class="hero__description">
                    {{ $section['description'] }}
                </p>

                <div class="hero__actions">
                    <x-button.link
                        class="main-btn"
                        label="Explore"
                    />

                    <x-button.link
                        class="outline-btn"
                        label="Contact"
                    />
                </div>

                <div class="hero__stats">
                    <div>
                        <h1 id="projects-number"></h1>
                        <p>Projects</p>
                    </div>

                    <div class="hero__divider"></div>

                    <div>
                        <h1 id="customers-number"></h1>
                        <p>Customers</p>
                    </div>

                    <div class="hero__divider"></div>

                    <div>
                        <h1 id="years-of-experience-number"></h1>
                        <p>Years of Experience</p>
                    </div>
                </div>
            </div>

            {{-- Right Side --}}
            <div class="hero__media">
                <div
                    class="hero__video-wrapper"
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
                <div class="hero__card hero__card--bottom">
                    <div class="hero__card-content">
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
