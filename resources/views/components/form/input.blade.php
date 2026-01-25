@props([
    'type' => 'text',
    'label' => null,
    'error' => null,
])

<div @class(['input-field', $attributes->get('class')])>

    <div>
        {{-- Label --}}
        @if ($label)
            <label for="{{ $attributes->whereStartsWith('id') }}">
                {{ $label }}
            </label>
        @endif

        {{-- Optional description --}}
        {{ $description ?? null }}
    </div>

    <div class="input-wrapper">
        <input
            type="{{ $type }}"
            {{ $attributes->whereStartsWith('id') }}
            {{ $attributes->whereStartsWith('name') }}
            {{ $attributes->whereStartsWith('value') }}
            {{ $attributes->whereStartsWith('placeholder') }}
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-model') }}
            {{ $attributes->whereStartsWith('disabled') }}
            {{ $attributes->whereStartsWith('pattern') }}
            {{ $attributes->whereStartsWith('required') }}
            {{ $attributes->whereStartsWith('minlength') }}
            {{ $attributes->whereStartsWith('maxlength') }}
        />

        {{-- Slot element --}}
        {{ $slot }}
    </div>

    {{-- Validation --}}
    <x-alert.validation-input :error="$error" />
</div>
