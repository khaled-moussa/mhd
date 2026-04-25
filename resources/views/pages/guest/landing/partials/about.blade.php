@props([
    'section' => [],
])

<section id="about" class="about">
    <div class="about__container">

        {{-- Header --}}
        <div class="about__header">
            <span class="section-label">Who we are</span>
            <h2>About us</h2>
        </div>

        {{-- Content --}}
        <div class="about__content">

            {{-- Left: Text --}}
            <div class="about__text">
                <p>{{ $section['description'] }}</p>
                <p>{{ $section['description_secondary'] ?? '' }}</p>
            </div>

            {{-- Right: Stats --}}
            <div class="about__stats">
                <div class="about__stat">
                    <h3>500+</h3>
                    <div class="about__stat-divider"></div>
                    <div class="about__stat-info">
                        <strong>Projects completed</strong>
                        <p>Delivered across industries worldwide</p>
                    </div>
                </div>
                <div class="about__stat">
                    <h3>200+</h3>
                    <div class="about__stat-divider"></div>
                    <div class="about__stat-info">
                        <strong>Satisfied clients</strong>
                        <p>Long-term partnerships built on trust</p>
                    </div>
                </div>
                <div class="about__stat">
                    <h3>10</h3>
                    <div class="about__stat-divider"></div>
                    <div class="about__stat-info">
                        <strong>Years experience</strong>
                        <p>A decade of crafting digital solutions</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>