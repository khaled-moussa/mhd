{{-- Site preview --}}
@includeIf('pages.guest.landing.index', ['sections' => $sections])

{{ Vite::script('shared/settings/site-editor/scripts/site-editor-preview.js') }}
