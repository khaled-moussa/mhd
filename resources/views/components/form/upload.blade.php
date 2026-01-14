@props([
    'name' => 'file',
    'description' => 'Drag & drop files here, or click to select files',
    'accept' => '.png,.jpg,.jpeg',
    'multiple' => false,
])

<div
    id="drag-area"
    class="drag-drop-input"
    wire:ignore
>
    <label
        id="{{ $attributes->get('id') }}"
        class="drag-drop-input__label"
    >

        <i class="fi fi-rr-cloud-upload"></i>

        <div class="drag-drop-input__text">
            <p>{{ $description }}</p>

            <p class="drag-drop-input__hint">
                Supported File Types: {{ $accept }}
            </p>
        </div>

        <input
            id="{{ $attributes->get('id') }}"
            name="{{ $name }}"
            type="file"
            class="hidden"
            accept="{{ $accept }}"
            @if ($multiple) multiple @endif
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('@') }}
        />
    </label>
</div>
