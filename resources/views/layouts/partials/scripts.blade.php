{{-- Share PHP enums to JS --}}
<script>
    window.__ENUMS__ = @json($JS_ENUMS ?? []);
    window.user = @json($authUser ?? null);
</script>

@livewireScripts

@stack('scripts')
