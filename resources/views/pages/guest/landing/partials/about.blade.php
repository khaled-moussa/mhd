@props([
    'section' => [],
])

<section
    id="about"
    class="about-section"
>
    <div class="about-container">

        {{-- Header --}}
        <x-header.section
            label="Who we are"
            :title="$section['title']"
        />

        {{-- Content --}}
        <div class="about-layout">

            {{-- Text --}}
            <div class="about-content">
                <p id="description">

                    {{ $section['description'] }}
                </p>
            </div>

            {{-- Stats --}}
            <div class="about-stats">

                <div class="about-card">
                    <h3 class="about-number">500</h3>

                    <div class="about-divider"></div>

                    <div class="about-info">
                        <strong>Projects completed</strong>
                        <p>Delivered across industries worldwide</p>
                    </div>
                </div>

                <div class="about-card">
                    <h3 class="about-number">870</h3>

                    <div class="about-divider"></div>

                    <div class="about-info">
                        <strong>Satisfied clients</strong>
                        <p>Long-term partnerships built on trust</p>
                    </div>
                </div>

                <div class="about-card">
                    <h3 class="about-number">10</h3>

                    <div class="about-divider"></div>

                    <div class="about-info">
                        <strong>Years experience</strong>
                        <p>A decade of crafting digital solutions</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
