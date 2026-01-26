@props(['modalId', 'modalTitle', 'description'])

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

            {{-- Modal Header --}}
            <header class="modal-header">
                <h2
                    id="{{ $modalId }}-title"
                    class="projects__modal-title"
                >
                    {{ $modalTitle}}
                </h2>

                <x-button.outline
                    class="modal-close"
                    data-custom-close="{{ $modalId }}"
                />
            </header>

            {{-- Modal Content --}}
            <main
                class="projects__modal-content"
                id="{{ $modalId }}-content"
            >

                {{-- Modal Body --}}
                <div class="projects__modal-body">

                    {{-- Carousel --}}
                    <div class="projects__modal-carousel">
                        <div
                            id="project-modal-splide"
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
                            id="{{ $modalId }}-info-title"
                            class="projects__modal-info-title"
                        >
                            {{ $modalTitle}}
                        </h3>
                        <p
                            id="{{ $modalId }}-description"
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
                                    x-description="projectData.delivered_at"
                                />

                                <x-label.info
                                    label="Price Start"
                                    x-description="`${projectData.price_start} EGP`"
                                />
                            </div>

                            <div class="projects__modal-row">
                                <x-label.info
                                    label="Address"
                                    x-description="projectData.address"
                                />
                            </div>
                        </div>


                        <div class="project-view__location">
                            <div class="project-view__location-header">
                                <i class="fi fi-ss-map-marker-home"></i>
                                <header class="project-view__location-title">
                                    Location
                                </header>
                            </div>

                            <!-- If location exists -->
                            <template x-if="projectData.location">
                                <iframe
                                    width="100%"
                                    height="300"
                                    loading="lazy"
                                    style="border:0"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    :src="projectData.location"
                                ></iframe>
                            </template>

                            <!-- If location is empty -->
                            <template x-if="!projectData.location">
                                <div class="project-view__no-location">
                                    <i class="fi fi-rr-info"></i>
                                    <span>No location found</span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Modal Actions --}}
                <div class="projects__modal-actions">
                    <x-button.main
                        label="Download Brochure"
                        @click="downloadBrochure()"
                    />

                    <x-button.outline
                        label="Close"
                        data-custom-close="projects-modal"
                    />
                </div>
            </main>
        </div>
    </div>
</div>
