@props([
    'label' => null,
    'description' => null,
    'xDescription' => null, // 👈 Alpine-only
    'placeholder' => false,
    'badgelabel' => null,
    'badgecolor' => null,
])

<div class="label-info">
    <div>
        @if ($label)
            <label>{{ $label }}</label>
        @endif

        {{-- Blade description --}}
        @if ($description)
            <p class="description">
                {{ $description }}
            </p>
        @endif

        {{-- Alpine description --}}
        @if ($xDescription)
            <p
                class="description"
                x-text="{{ $xDescription }}"
            ></p>
        @endif

        @if ($badgelabel && $badgecolor)
            <p class="badge {{ $badgecolor }}">
                {{ $badgelabel }}
            </p>
        @endif

        @if ($placeholder && !$description && !$xDescription)
            <p class="description">
                {{ "No {$label}" }}
            </p>
        @endif

        {{ $content ?? null }}
    </div>

    <div class="label-content">
        {{ $slot }}
    </div>
</div>
