@props([
    'label' => null,
    'error' => null,
])

<label
    for="hr"
    class="checkbox"
>
    <input
        id="hr"
        type="checkbox"
        class="peer hidden"
        {{ $attributes->whereStartsWith('id') }}
        {{ $attributes->whereStartsWith('name') }}
        {{ $attributes->whereStartsWith('value') }}
        {{ $attributes->whereStartsWith('wire') }}
        {{ $attributes->whereStartsWith('x-') }}
        {{ $attributes->whereStartsWith('data') }}
        {{ $attributes->whereStartsWith('@click') }}
        {{ $attributes->whereStartsWith('required') }}
    />

    <div
        {{ $attributes->whereStartsWith('id') }}
        class=checkbox-icon"
    >
        <svg
            fill="none"
            viewBox="0 0 24 24"
            class="checkbox-svg"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M4 12.6111L8.92308 17.5L20 6.5"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></path>
        </svg>
    </div>

    @if ($label)
        <span>
            {{ $label }}
        </span>
    @endif
</label>

{{-- Validation --}}
<x-alert.validation-input :error="$error" />
