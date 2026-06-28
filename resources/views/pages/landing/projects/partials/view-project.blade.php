@props(['modalId'])

<div
    class="modal projects-modal"
    id="{{ $modalId }}"
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
            aria-labelledby="projects-modal-title"
        >
            <div class="projects-modal-body">

                {{-- Gallery --}}
                <div class="projects-modal-gallery">
                    <div
                        id="project-modal-splide"
                        class="splide"
                    ></div>
                </div>

                {{-- Panel --}}
                <div class="projects-modal-panel">

                    {{-- Modal header --}}
                    <header class="modal-header">
                        <h2
                            id="projects-modal-title"
                            class="modal-title"
                        ></h2>

                        <x-button.icon
                            class="modal-close-btn"
                            :data-custom-close="$modalId"
                        />
                    </header>

                    {{-- Modal description --}}
                    <p
                        id="projects-modal-description"
                        class="modal-description"
                    ></p>

                    {{-- Details --}}
                    <div class="projects-modal-details">

                        <div class="projects-modal-grid">

                            <div class="projects-modal-item">
                                <div class="projects-modal-label">
                                    Delivered
                                </div>

                                <div
                                    id="project-delivered"
                                    class="projects-modal-value"
                                ></div>
                            </div>

                            <div class="projects-modal-item">
                                <div class="projects-modal-label">
                                    Price Start
                                </div>

                                <div
                                    id="project-price"
                                    class="projects-modal-value"
                                ></div>
                            </div>

                            <div class="projects-modal-item full">
                                <div class="projects-modal-label">
                                    Address
                                </div>

                                <div
                                    id="project-address"
                                    class="projects-modal-value"
                                ></div>
                            </div>

                        </div>

                        {{-- Location --}}
                        <div class="project-location">

                            <div class="project-location-header">
                                <i class="fi fi-ss-map-marker-home"></i>

                                <span class="project-location-title">
                                    Location
                                </span>
                            </div>

                            <iframe
                                id="project-location"
                                width="100%"
                                height="260"
                                style="border:0;"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>

                            <div
                                id="project-location-empty"
                                class="project-location-empty"
                            >
                                <p>No location added</p>
                            </div>

                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="modal-actions">

                        <x-button.outlined
                            class="modal-close"
                            label="Close"
                            data-custom-close="{{ $modalId }}"
                        />

                        <x-button.primary
                            id="brochure-btn"
                            class="primary-btn"
                            label="Download brochure"
                            onclick="downloadProjectBrochure(event)"
                        >
                            <i class="fi fi-rr-download"></i>
                        </x-button.primary>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
