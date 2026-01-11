@props([
    'label' => null,
    'options' => [],
    'error' => null,
])

<div
    @class(['input-field', $attributes->get('class')])
    {{ $attributes->whereStartsWith(needles: 'wire:ignore') }}
>

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

    <div
        class="input-wrapper"
        wire:ignore
    >
        <input
            type="text"
            class="tagify-input tagify--custom-dropdown customLook"
            {{ $attributes->whereStartsWith('id') }}
            {{ $attributes->whereStartsWith('name') }}
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('required') }}
        />

        {{-- Slot element --}}
        {{ $slot }}
    </div>

    {{-- Validation --}}
    <x-alert.validation-input :error="$error" />
</div>
