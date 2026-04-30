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
                        <span>{{ $section['phone'] ?? '+966 50 000 0000' }}</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon">
                        <i class="fi fi-rr-envelope"></i>
                    </div>

                    <div class="contact-item-text">
                        <strong>Email</strong>
                        <span>{{ $section['email'] ?? 'hello@mhd.dev' }}</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon">
                        <i class="fi fi-rr-marker"></i>
                    </div>

                    <div class="contact-item-text">
                        <strong>Office</strong>
                        <span>{{ $section['address'] ?? 'Riyadh, Saudi Arabia' }}</span>
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
