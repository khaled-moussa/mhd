@props(['modalId', 'title', 'description'])

<div
    class="modal projects__modal"
    id="{{ $modalId }}"
    aria-hidden="true"
    x-data="projectViewComponent"
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
            aria-labelledby="{{ $modalId }}-title"
        >
            <div class="projects__modal-body">

                {{-- Left: Carousel --}}
                <div class="projects__modal-carousel">
                    <div
                        id="project-modal-splide"
                        class="splide"
                    >
                        <div class="splide__track">
                            <div
                                class="splide__list"
                                id="projects-modal-carousel-list"
                            ></div>
                        </div>
                    </div>
                </div>

                {{-- Right: Info Panel --}}
                <div class="projects__modal-info-panel">

                    {{-- Header --}}
                    <div class="projects__modal-info-header">
                        <div class="projects__modal-close-row">
                            <x-button.outline
                                class="modal-close"
                                data-custom-close="{{ $modalId }}"
                            />
                        </div>
                        <h2
                            id="{{ $modalId }}-title"
                            class="projects__modal-info-title"
                        >{{ $title }}</h2>
                        <p
                            id="{{ $modalId }}-description"
                            class="projects__modal-info-desc"
                        >{{ $description }}</p>
                    </div>

                    {{-- Details --}}
                    <div class="projects__modal-details-section">
                        <div class="projects__modal-detail-grid">
                            <div class="projects__modal-detail-item">
                                <div class="projects__modal-detail-label">Delivered</div>
                                <div
                                    class="projects__modal-detail-value"
                                    x-text="projectData.delivered_at"
                                ></div>
                            </div>
                            <div class="projects__modal-detail-item">
                                <div class="projects__modal-detail-label">Price start</div>
                                <div
                                    class="projects__modal-detail-value"
                                    x-text="`${projectData.price_start} EGP`"
                                ></div>
                            </div>
                            <div class="projects__modal-detail-item projects__modal-detail-item--full">
                                <div class="projects__modal-detail-label">Address</div>
                                <div
                                    class="projects__modal-detail-value"
                                    x-text="projectData.address"
                                ></div>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="project-view__location">
                            <div class="project-view__location-header">
                                <i class="fi fi-ss-map-marker-home"></i>
                                <span class="project-view__location-title">Location</span>
                            </div>

                            <template x-if="projectData.location">
                                <iframe
                                    width="100%"
                                    loading="lazy"
                                    style="border:0"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    :src="projectData.location"
                                ></iframe>
                            </template>

                            <template x-if="!projectData.location">
                                <div class="project-view__no-location">
                                    <i class="fi fi-rr-info"></i>
                                    <span>No location available</span>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="projects__modal-actions">
                        <x-button.main
                            class="main-btn"
                            label="Download brochure"
                            @click="downloadBrochure()"
                        >
                            <i class="fi fi-rr-download"></i>
                        </x-button.main>
                        <x-button.outline
                            class="outline-btn"
                            label="Close"
                            data-custom-close="projects-modal"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
