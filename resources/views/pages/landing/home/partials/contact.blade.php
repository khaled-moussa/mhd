@props([
    'section' => [],
])

<section
    id="contact"
    class="contact-section"
>
    <div class="contact-container">

        {{-- Header --}}
        <x-header.section
            label="Get in touch"
            :title="$section['title']"
            :description="$section['description']"
        />

        <div class="contact-layout">

            {{-- Contact Info --}}
            <div class="contact-info">

                <div class="contact-item">
                    <div class="contact-item-icon">
                        <i class="fi fi-rr-phone-call"></i>
                    </div>

                    <div class="contact-item-text">
                        <strong>Phone</strong>

                        <a
                            href="tel:15018"
                            class="contact-item-link"
                        >
                            15018
                        </a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon">
                        <i class="fi fi-rr-envelope"></i>
                    </div>

                    <div class="contact-item-text">
                        <strong>Email</strong>

                        <a
                            href="mailto:hello@mhd.dev"
                            class="contact-item-link"
                        >
                            hello@mhd.dev
                        </a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon">
                        <i class="fi fi-rr-marker"></i>
                    </div>

                    <div class="contact-item-text">
                        <strong>Office Address</strong>

                        <a
                            href="https://maps.app.goo.gl/zPZWCu2xnptLA5rn7?g_st=ic"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-item-link"
                        >
                            <span>
                                MHD, Sheraton Al Matar, El Nozha,
                                Cairo Governorate 4471321, Egypt
                            </span>

                            <br />

                            <span class="underline">View location on Google Maps</span>
                        </a>
                    </div>
                </div>

                <div class="contact-note">
                    <p>
                        We typically respond within <strong>24 hours</strong>.
                        For urgent inquiries, feel free to call us directly.
                    </p>
                </div>

            </div>

            {{-- Contact Form --}}
            <div class="contact-card">
                <livewire:guest.contacts.contact-form-create-component />
            </div>
        </div>
    </div>
</section>
