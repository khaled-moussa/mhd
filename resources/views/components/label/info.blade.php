@props([
    'label' => null,
    'description' => null,
    'placeholder' => false,
    'badgelabel' => null,
    'badgecolor' => null,
])

<div class="label-info">
    <div>
        @if ($label)
            <label>
                {{ $label }}
            </label>
        @endif

        @if ($description)
            <p class="description">
                {{ $description }}
            </p>
        @endif

        @if ($badgelabel && $badgecolor)
            <p class="badge {{ $badgecolor }}">
                {{ $badgelabel }}
            </p>
        @endif

        @if ($placeholder && !$description)
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
