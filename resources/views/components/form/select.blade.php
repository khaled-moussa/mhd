@props([
    'type' => 'text',
    'label' => null,
    'options' => [],
])

<div   
    @class([
        'input-field',
        $attributes->get('class'),
    ])>

    <div>
        {{-- Label --}}
        @if($label)
            <label for="{{ $attributes->get('id') }}">
                {{ $label }}
            </label>
        @endif

        {{-- Optional description --}}
        {{ $description ?? null }}
    </div>

    <div class="input-wrapper">
        <select
            id="{{ $attributes->get('id') }}"
            name="{{ $attributes->get('name') }}"
            {{ $attributes->whereStartsWith('wire') }}
            {{ $attributes->whereStartsWith('x-') }}
            {{ $attributes->whereStartsWith('@') }}
        >
            @if ($attributes->has(['placeholder']))
                <option value="" disabled selected>{{ $attributes->get('placeholder') }}</option>
            @endif

            {{-- Render dynamic options --}}
            @foreach ($options as $option)
                <option value="{{ $option['value'] ?? $option }}">
                    {{ $option['label'] ?? $option }}
                </option>
            @endforeach
        </select>

        {{-- Slot element --}}
        {{ $slot }}
    </div>
</div>
