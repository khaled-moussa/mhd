@props([
    'eyebrow' => null,
    'subtitle' => null,
    'description' => null,
])

<div class="auth-page">

    <div class="auth-form-wrap">
        <x-button.link
            class="outlined-btn sm left"
            label="Back Home"
            :href="route('landing')"
        />

        {{-- Header --}}
        <div class="auth-header">
            @if ($eyebrow)
                <p class="auth-eyebrow">
                    {{ $eyebrow }}
                </p>
            @endif

            @if ($subtitle)
                <h1 class="auth-title">
                    {{ $subtitle }}
                </h1>
            @endif

            @if ($description)
                <p class="auth-subtitle">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{-- Form Slot --}}
        {{ $form }}
    </div>
</div>
