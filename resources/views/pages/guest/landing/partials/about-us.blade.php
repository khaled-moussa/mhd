@props([
    'section' => [],
])

<section
    id="about-us"
    class="about"
>
    <div class="about__container">
        {{-- Header --}}
        <x-header.section
            class="about__header"
            title="About Us"
        />

        {{-- Content --}}
        <div class="about__content">

            {{-- Left: Text --}}
            <div class="about__text">
                <p class="section-description">
                    {{ $section['description'] }}
                </p>

                {{-- Optional: Highlight stats or feature points --}}
                <div class="about__stats">
                    <div class="about__stat">
                        <h3>500+</h3>
                        <p>Projects Completed</p>
                    </div>
                    <div class="about__stat">
                        <h3>200+</h3>
                        <p>Satisfied Clients</p>
                    </div>
                    <div class="about__stat">
                        <h3>10</h3>
                        <p>Years Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
