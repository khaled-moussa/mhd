@props([
    'label' => null,
    'options' => [],
    'error' => null,
])

<div @class(['input-field', $attributes->get('class')])>

    {{-- Label + Description --}}
    <div>

        @if ($label)
            <label for="{{ $attributes->get('id') }}">
                {{ $label }}
            </label>
        @endif

        {{ $description ?? null }}

    </div>


    {{-- Wrapper --}}
    <div class="input-wrapper">

        <select
            {{-- Core Attributes --}}
            id="{{ $attributes->get('id') }}"
            name="{{ $attributes->get('name') }}"
            value="{{ $attributes->get('value') }}"
            placeholder="{{ $attributes->get('placeholder') }}"
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
        >

            {{-- Options --}}
            @foreach ($options as $option)
                <option value="{{ $option['value'] ?? $option }}">
                    {{ $option['label'] ?? $option }}
                </option>
            @endforeach

        </select>

        {{-- Slot (icons, buttons, etc.) --}}
        {{ $slot }}

    </div>

    {{-- Validation --}}
    {{-- <x-alert.validation-input :error="$error" /> --}}
</div>
