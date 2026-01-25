@props([
    'section' => [],
])

<section
    id="contact"
    class="contact-section"
>
    <div class="contact-container">
        {{-- Header Section --}}
        <x-header.section
            :title="$section['title']"
            :description="$section['description']"
        />

        <div class="contact-card">
            <div class="spotlight"></div>

            <h2 class="contact-title">
                <span class="text-gradient">Get in Touch</span>
            </h2>

            <p
                class="contact-subtitle"
                style="animation-delay: 0.2s;"
            >
                Have a question or want to collaborate?
            </p>

            <form action="">
                <div class="input-field">
                    <label for="name">Name</label>
                    <input
                        id="name"
                        type="text"
                    />
                </div>

                <div class="input-field">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                    />
                </div>

                <div class="input-field">
                    <label for="message">Message</label>
                    <textarea id="message"></textarea>
                </div>

                <x-button.main
                    label="Send Message"
                    class="form-button"
                />
            </form>
        </div>
    </div>
</section>
