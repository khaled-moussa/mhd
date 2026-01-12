<x-form.upload />

<x-form.input
    label="Title"
    wire:model="form.title"
    error="form.title"
/>

<x-form.input
    label="Description"
    wire:model="form.description"
    error="form.description"
/>

<div class="company-project__form-row">
    <x-form.input
        type="date"
        label="Delivered At"
        wire:model="form.deliveredAt"
        error="form.deliveredAt"
    />

    <x-form.input
        label="Price Start"
        wire:model="form.priceStart"
        error="form.priceStart"
    />
</div>

<x-form.input
    label="Address"
    wire:model="form.address"
    error="form.address"
/>

<x-form.input
    label="Location"
    wire:model="form.location"
    error="form.location"
/>
