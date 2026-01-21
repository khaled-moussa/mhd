<x-form.input
    label="Title"
    wire:model="form.icon"
    error="form.icon"
/>

<x-form.input
    label="Title"
    wire:model="form.title"
    error="form.title"
    required
/>

<x-form.input
    label="Description"
    wire:model="form.description"
    error="form.description"
    required
/>

<x-form.toggle
    label="Visible"
    wire:model="form.visible"
    error="form.visible"
/>
