<x-form.input
    label="Icon"
    wire:model="form.icon"
    error="form.icon"
    maxlength="255"
>
    <p class="description">
        Copy the icon tag from
        <a
            href="https://www.flaticon.com/icon-fonts-most-downloaded"
            class="link-url"
            target="_blank"
        >
            Flaticon
        </a>
        and paste it here.
    </p>

</x-form.input>

<x-form.input
    label="Title"
    wire:model="form.title"
    error="form.title"
    required
    minlength="3"
    maxlength="255"
/>

<x-form.textarea
    label="Description"
    wire:model="form.description"
    error="form.description"
    required
    minlength="10"
    maxlength="255"
/>

<x-form.checkbox
    label="Visible"
    wire:model="form.visible"
    error="form.visible"
/>
