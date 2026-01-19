@props([
    'id' => 'projects-modal',
    'title' => '',
    'description' => '',
])

<div
    id="{{ $id }}"
    class="modal projects__modal"
    aria-hidden="true"
>
    <div
        class="modal-overlay"
        tabindex="-1"
        data-micromodal-close
    >
        <div
            class="modal-container xl"
            role="dialog"
            aria-modal="true"
            aria-labelledby="{{ $id }}-title"
        >

            {{-- Modal Header --}}
            <header class="modal-header">
                <h2
                    id="{{ $id }}-title"
                    class="projects__modal-title"
                >
                    {{ $title }}
                </h2>

                <x-button.outline
                    class="modal-close"
                    data-custom-close="{{ $id }}"
                />
            </header>

            {{-- Modal Content --}}
            <main
                class="projects__modal-content"
                id="{{ $id }}-content"
            >

                {{-- Modal Body --}}
                <div class="projects__modal-body">

                    {{-- Carousel --}}
                    <div class="projects__modal-carousel">
                        <div
                            id="splide"
                            class="splide"
                        >
                            <div class="splide__track">
                                <div
                                    class="splide__list"
                                    id="projects-modal-carousel-list"
                                >
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="projects__modal-info">
                        <h3
                            id="{{ $id }}-info-title"
                            class="projects__modal-info-title"
                        >
                            {{ $title }}
                        </h3>
                        <p
                            id="{{ $id }}-description"
                            class="projects__modal-info-desc"
                        >
                            {{ $description }}
                        </p>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="projects__modal-footer">
                    <div class="projects__modal-card">
                        <header>Information</header>
                        <div class="projects__modal-details">
                            <div class="projects__modal-row">
                                <x-label.info
                                    label="Delivered"
                                    description="August 2025"
                                />

                                <x-label.info
                                    label="Price Start"
                                    description="150,000 LE"
                                />
                            </div>

                            <div class="projects__modal-row">
                                <x-label.info
                                    label="Address"
                                    description="Masr Gdeda - Nozha"
                                />

                                <x-label.info
                                    label="Location"
                                    description="+20 1015571129"
                                />
                            </div>
                        </div>

                        <div class="projects__modal-location">
                            <div class="projects__modal-location-header">
                                <i class="fi fi-ss-map-marker-home"></i>
                                <header class="projects__modal-location-title">Location</header>
                            </div>

                            <iframe
                                id="projects-modal-map"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps/embed?pb=..."
                            ></iframe>
                        </div>
                    </div>
                </div>

                {{-- Modal Actions --}}
                <div class="projects__modal-actions">
                    <x-button.main label="Download Brochure" />
                    <x-button.outline
                        label="Close"
                        data-custom-close="projects-modal"
                    />
                </div>
            </main>
        </div>
    </div>
</div>
