{{-- Share PHP enums to JS --}}
<script>
    window.__ENUMS__ = @json($enums ?? []);
    window.__USER__ = @json($currentUser ?? null);
</script>

@livewireScripts

@stack('scripts')
