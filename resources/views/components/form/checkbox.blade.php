@props([
    'label' => null,
    'error' => null,
])

<label @class(['checkbox-field', $attributes->get('class')])>

    {{-- Wrapper --}}
    <div class="checkbox-wrapper">

        {{-- Input --}}
        <input
            type="checkbox"
            class="peer hidden"
            {{-- Core Attributes --}}
            @if ($attributes->has('id')) id="{{ $attributes->get('id') }}" @endif
            @if ($attributes->has('name')) name="{{ $attributes->get('name') }}" @endif
            @if ($attributes->has('value')) value="{{ $attributes->get('value') }}" @endif

            {{-- State --}}
            {{ $attributes->whereStartsWith('checked') }}
            {{ $attributes->whereStartsWith('required') }}
            {{ $attributes->whereStartsWith('disabled') }}
            
            {{-- JS / Alpine / Livewire --}}
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('@') }}
        />

        {{-- Icon --}}
        <div class="checkbox-icon">
            <svg
                class="checkbox-svg"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M4 12.6111L8.92308 17.5L20 6.5"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>

        {{-- Label Text --}}
        @if ($label)
            <span class="checkbox-label">
                {{ $label }}
            </span>
        @endif

    </div>
</label>

{{-- Validation --}}
<x-alert.validation-input :error="$error" />
