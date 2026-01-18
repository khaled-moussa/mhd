<div x-data="projectViewComponent">
    <div class="project-view__modal-content">
        {{-- Modal Body --}}
        <div class="project-view__modal-body">

            {{-- Carousel --}}
            <div class="project-view__carousel">
                <div
                    id="splide"
                    class="splide"
                    wire:ignore
                >
                    <div class="splide__track">
                        <div
                            class="splide__list"
                            id="project-view-carousel-list"
                        >
                            <template x-for="image in projectData.images">
                                <div class="splide__slide project-view__image">
                                    <img
                                        :src="image.path"
                                        alt="Project Image"
                                    >
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="project-view__info">
                <h3
                    class="project-view__title"
                    x-text="projectData.title"
                >
                </h3>

                <p
                    class="project-view__description"
                    x-text="projectData.description"
                >
                </p>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="project-view__footer">
            <div class="project-view__card">
                <header>Information</header>

                <div class="project-view__details">
                    <div class="project-view__row">
                        <x-label.info label="Delivered">
                            <x-slot:content>
                                <p
                                    class="description"
                                    x-text="`${projectData.delivered_at ?? 'No delivered date yet'}`"
                                >
                                </p>
                            </x-slot:content>
                        </x-label.info>

                        <x-label.info label="Delivered">
                            <x-slot:content>
                                <p
                                    class="description"
                                    x-text="projectData.delivered_at ? projectData.delivered_at : 'No delivered date yet'"
                                ></p>
                            </x-slot:content>
                        </x-label.info>

                    </div>

                    <div class="project-view__row">
                        <x-label.info label="Address">
                            <x-slot:content>
                                <p
                                    class="description"
                                    x-text="projectData.address"
                                >
                                </p>
                            </x-slot:content>
                        </x-label.info>
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
        <div class="project-view__actions">
            <x-button.main label="Download Brochure" />
            <x-button.outline
                label="Close"
                data-custom-close="project-view-modal"
            />
        </div>
    </div>
</div>
