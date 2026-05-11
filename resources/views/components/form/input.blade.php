@props([
    'type'  => 'text',
    'label' => null,
    'error' => null,
])

<div
    @class([
        'input-field',
        $attributes->get('class'),
    ])
>

    {{-- Label + Description --}}
    <div>

        @if ($label)
            <label
                @if ($attributes->has('id'))
                    for="{{ $attributes->get('id') }}"
                @endif
            >
                {{ $label }}
            </label>
        @endif

        {{ $description ?? null }}

    </div>

    {{-- Wrapper --}}
    <div class="input-wrapper">

        <input
            type="{{ $type }}"

            {{-- Core Attributes --}}
            @if ($attributes->has('id'))
                id="{{ $attributes->get('id') }}"
            @endif

            @if ($attributes->has('name'))
                name="{{ $attributes->get('name') }}"
            @endif

            @if ($attributes->has('value'))
                value="{{ $attributes->get('value') }}"
            @endif

            @if ($attributes->has('placeholder'))
                placeholder="{{ $attributes->get('placeholder') }}"
            @endif

            {{-- State --}}
            {{ $attributes->whereStartsWith('required') }}
            {{ $attributes->whereStartsWith('disabled') }}

            {{-- Validation --}}
            {{ $attributes->whereStartsWith('min') }}
            {{ $attributes->whereStartsWith('max') }}
            {{ $attributes->whereStartsWith('minlength') }}
            {{ $attributes->whereStartsWith('maxlength') }}
            {{ $attributes->whereStartsWith('pattern') }}

            {{-- JS / Alpine / Livewire --}}
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('@') }}
        />

        {{-- Slot (icons, buttons, etc.) --}}
        {{ $slot }}

    </div>

    {{-- Validation --}}
    <x-alert.validation-input :error="$error" />
</div>