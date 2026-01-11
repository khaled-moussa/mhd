@props([
    'section' => [],
])

<section id="projects" class="projects-section">
    <div id="project-container" class="projects-container">

        {{-- Header Section --}}
        <x-header.section title="Our Projects"
            paragraph="Explore some of our recent real estate developments — from modern apartments to commercial complexes." />

        {{-- Projects Grid --}}
        <div class="projects-grid">
            @foreach ($section['data'] as $project)
                <div class="project-card" onclick="openProject(@js($project))">
                    <x-asset.img folder="backgrounds" :img="$project['img']" class="project-image" />

                    <div class="project-content">
                        <h3 class="project-title">{{ $project['title'] }}</h3>
                        <p class="project-desc">{{ $project['delivered'] }}</p>
                        <p class="project-desc">{{ $project['address'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Load More Button --}}
        <div class="load-more-btn">
            <x-button.outline id="load-more-btn" label="Load more" />
        </div>
    </div>
</section>

{{-- Project Modal --}}
<div id="open-project-modal" class="modal project-modal" aria-hidden="true">
    <div class="modal-overlay" tabindex="-1" data-micromodal-close>
        <div class="modal-container xl" role="dialog" aria-modal="true" aria-labelledby="open-project-modal-title">

            {{-- Modal Header --}}
            <header class="modal-header">
                <h2 class="modal-title" id="open-project-modal-title"></h2>
                <x-button.outline class="modal-close" data-custom-close="open-project-modal" />
            </header>

            {{-- Modal Content --}}
            <main class="modal-content" id="open-project-modal-content">

                {{-- Project modal body --}}
                <div class="project-modal-body">

                    {{-- Project image carousel --}}
                    <div class="project-modal-carousel">
                        <div id="splide" class="splide">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <div class="splide__slide">
                                        {{-- Project Image --}}
                                        <div class="project-modal-image">
                                            <x-asset.img folder="mockups" img="project-1.jpg" class="hero-bg.jpg"
                                                alt="1" />
                                        </div>
                                    </div>
                                    <div class="splide__slide">
                                        {{-- Project Image --}}
                                        <div class="project-modal-image">
                                            <x-asset.img folder="mockups" img="project-2.jpg" class="hero-bg.jpg"
                                                alt="1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Project info --}}
                    <div class="project-modal-info">
                        <h3 id="project-modal-title" class="project-modal-title"></h3>

                        <p id="project-modal-description" class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia rerum vero
                            repellendus ducimus, cumque sequi quae enim explicabo cum blanditiis odio voluptate itaque
                            quam
                            in iste delectus ut laboriosam repudiandae eius dignissimos voluptas vel vitae ad harum?
                            Unde
                            tempore voluptatum eveniet debitis mollitia assumenda. Aliquid doloremque amet maiores
                            cupiditate ipsam?
                        </p>
                    </div>
                </div>

                {{-- Project modal footer --}}
                <div class="project-modal-footer">
                    <div class="card">
                        <header>Information</header>

                        <div class="project-details">
                            <div class="project-content">
                                <x-label.info label="Delieverd" description="Augest 2025" />
                                <x-label.info label="Price Start" description="150,000 LE" />
                            </div>

                            <div class="project-content">
                                <x-label.info label="Address" description="Masr Gdeda - Nozha" />
                                <x-label.info label="Location" description="+20 1015571129" />
                            </div>
                        </div>

                        <div class="location">
                            <div class="details">
                                <i class="fi fi-ss-map-marker-home"></i>
                                <header class="title">Location</header>
                            </div>

                            <iframe id="project-map" width="100%" height="300" style="border:0;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.686378325519!2d31.2357113151147!3d30.04441908188357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145840d93f5649d7%3A0x4b59e8eb1d197bcb!2sTahrir%20Square!5e0!3m2!1sen!2seg!4v1696841873324!5m2!1sen!2seg">
                            </iframe>
                        </div>
                    </div>
                </div>

                {{-- Project modal actions --}}
                <div class="project-modal-actions">
                    <x-button.main label="Download Brochure" />
                    <x-button.outline label="Close" data-custom-close="open-project-modal" />
                </div>
            </main>
        </div>
    </div>
</div>
