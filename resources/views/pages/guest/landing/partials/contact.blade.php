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


            {{-- Contact form create livewire --}}
            <livewire:guest.contacts.contact-form-create-component />
        </div>
    </div>
</section>
