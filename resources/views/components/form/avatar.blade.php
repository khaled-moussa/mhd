@props([
    'name' => 'file',
    'description' => 'Upload Avatar',
    'accept' => '.png,.jpg,.jpeg',
])

<div 
    class="drag-drop-input"
    id="dragArea"
    wire:ignore
>
    <label 
        id="{{ $attributes->get('id') }}"
         class="drag-drop-input__label avatar">

        <i class="fi fi-rr-cloud-upload"></i>

        <p class="drag-drop-input__text">
            {{ $description }}
        </p>

        <input 
            id="{{ $attributes->get('id') }}"
            name="{{ $name }}"
            type="file"
            class="hidden"
            accept="{{ $accept }}"
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('@') }}
        />
    </label>
</div>
