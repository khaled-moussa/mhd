@props([
    'section' => [],
])

<section id="contact" class="contact-section">
    <div class="contact-container">

        {{-- Header --}}
        <div class="contact-header">
            <span class="section-label">Get in touch</span>
            <h2>{{ $section['title'] }}</h2>
            <p>{{ $section['description'] }}</p>
        </div>

        <div class="contact-layout">

            {{-- Left: Info --}}
            <div class="contact-info">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fi fi-rr-phone-call"></i>
                    </div>
                    <div class="contact-info-text">
                        <strong>Phone</strong>
                        <span>{{ $section['phone'] ?? '+966 50 000 0000' }}</span>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fi fi-rr-envelope"></i>
                    </div>
                    <div class="contact-info-text">
                        <strong>Email</strong>
                        <span>{{ $section['email'] ?? 'hello@mhd.dev' }}</span>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fi fi-rr-marker"></i>
                    </div>
                    <div class="contact-info-text">
                        <strong>Office</strong>
                        <span>{{ $section['address'] ?? 'Riyadh, Saudi Arabia' }}</span>
                    </div>
                </div>

                <div class="contact-info-note">
                    <p>We typically respond within <strong>24 hours</strong>. For urgent inquiries, feel free to call us directly.</p>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="contact-card">
                <livewire:guest.contacts.contact-form-create-component />
            </div>

        </div>
    </div>
</section>