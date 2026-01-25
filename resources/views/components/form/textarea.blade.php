@props([
    'label' => null,
    'error' => null,
])

<div @class(['input-field', $attributes->get('class')])>

    <div>
        {{-- Label --}}
        @if ($label)
            <label for="{{ $attributes->get('id') }}">
                {{ $label }}
            </label>
        @endif

        {{-- Optional description --}}
        {{ $description ?? null }}
    </div>

    <div class="input-wrapper">
        <textarea
            {{ $attributes->whereStartsWith('id') }}
            {{ $attributes->whereStartsWith('name') }}
            {{ $attributes->whereStartsWith('value') }}
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('required') }}
            {{ $attributes->whereStartsWith('minlength') }}
            {{ $attributes->whereStartsWith('maxlength') }}
        >
        </textarea>

        {{-- Slot element --}}
        {{ $slot }}
    </div>

    {{-- Validation --}}
    <x-alert.validation-input :error="$error" />
</div>
