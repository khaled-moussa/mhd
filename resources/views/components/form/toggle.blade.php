@props([
    'id' => null,
    'checked' => false,
    'label' => null,
])

<div class="input-field">
    @if ($label)
        <label>
            {{ $label }}
        </label>
    @endif

    <label class="toggle">
        <input class="peer sr-only" type="checkbox" id="{{ $attributes->get('id') }}" name="{{ $attributes->get('name') }}"
               {{ $attributes->whereStartsWith('wire') }} {{ $attributes->whereStartsWith('x-') }}
               {{ $attributes->whereStartsWith('@click') }} />

        {{-- Toggle circle --}}
        <span class="toggle-circle"></span>
    </label>

</div>
