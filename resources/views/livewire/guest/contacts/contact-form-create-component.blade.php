<form
    id="{{ $formId['CREATE_CONTACT_FORM'] }}"
    x-data="createContactComponent"
    wire:submit.prevent="submit"
>
    <div class="input-field">
        <x-form.input
            id="name"
            label="Name"
            wire:model="name"
            error="name"
            required
        />
    </div>

    <div class="input-field">
        <x-form.input
            type="email"
            id="email"
            label="Email"
            wire:model="email"
            error="email"
            required
        />
    </div>

    <div class="input-field">
        <x-form.input
            type="tel"
            id="phone"
            label="Phone"
            wire:model="phone"
            error="phone"
            minlength="8"
            maxlength="15"
        />
    </div>

    <div class="input-field">
        <x-form.textarea
            id="message"
            label="Message"
            wire:model="message"
            error="message"
            required
        />
    </div>

    <x-button.primary
        label="Send Message"
        class="primary-btn-full"
        wire:target="submit"
        wire:loading.class="spinner"
    />
</form>
