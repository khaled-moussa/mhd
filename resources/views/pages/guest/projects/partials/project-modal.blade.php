@props(['modalId', 'title' => '', 'description' => ''])

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

                    {{-- Header --}}
                    <div class="modal-header">
                        <x-button.outlined
                            class="modal-close"
                            data-custom-close="{{ $modalId }}"
                        />
                        <h2
                            id="projects-modal-title"
                            class="modal-title"
                        >
                            {{ $title }}
                        </h2>
                        <p
                            id="projects-modal-description"
                            class="modal-description"
                        >
                            {{ $description }}
                        </p>
                    </div>

                    {{-- Details --}}
                    <div class="projects-modal-details">
                        <div class="projects-modal-grid">

                            <div class="projects-modal-item">
                                <div class="projects-modal-label">Delivered</div>
                                <div
                                    id="project-delivered"
                                    class="projects-modal-value"
                                ></div>
                            </div>

                            <div class="projects-modal-item">
                                <div class="projects-modal-label">Price Start</div>
                                <div
                                    id="project-price"
                                    class="projects-modal-value"
                                ></div>
                            </div>

                            <div class="projects-modal-item full">
                                <div class="projects-modal-label">Address</div>
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
                                <span class="project-location-title">Location</span>
                            </div>

                            @if (isset($project['test']) && !is_null($project['location']))
                                <iframe
                                    id="project-location"
                                    width="100%"
                                    height="260"
                                    loading="lazy"
                                    style="border:0"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    :src="{{ $project['location'] }}"
                                >
                            </iframe @else <div class="project-location-empty">
                                <p>No location added</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="modal-actions">
                    <x-button.primary
                        class="primary-btn"
                        label="Download brochure"
                    >
                        <i class="fi fi-rr-download"></i>
                        </x-button.main>

                        <x-button.outlined
                            class="outline-btn"
                            label="Close"
                            data-custom-close="{{ $modalId }}"
                        />
                </div>
            </div>
        </div>
    </div>
</div>
</div>
