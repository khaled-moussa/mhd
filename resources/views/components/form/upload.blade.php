@props([
    'inputId',
    'dragId',
    'name' => 'file',
    'description' => 'Drag & drop files here, or click to select files',
    'accept' => '.png,.jpg,.jpeg',
    'multiple' => false,
    'error' => null,
])

<div
    id="{{ $dragId }}"
    class="drag-drop-input"
    wire:ignore
>
    <label
        id="{{ $inputId }}"
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
            id="{{ $inputId }}"
            name="{{ $name }}"
            type="file"
            class="hidden"
            accept="{{ $accept }}"
            @if ($multiple) multiple @endif
            {{ $attributes->whereStartsWith('required') }}
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('@') }}
        />
    </label>
</div>

{{-- Validation --}}
<x-alert.validation-input :error="$error" />
