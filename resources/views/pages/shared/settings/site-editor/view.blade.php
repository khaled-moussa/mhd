{{-- Site preview --}}
@include('pages.landing.home.index', [
    'sections' => $sections
])

{{ Vite::script('shared/settings/site-editor/scripts/site-editor-preview.js') }}
