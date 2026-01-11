<nav class="navbar">
	{{-- Menu toggle --}}
	<x-button.outline
		id="navbar-side-expand-btn"
		class="toggle-btn"
	>
		<i class="fi fi-sr-menu-burger"></i>
	</x-button.outline>

	{{-- Brand --}}
	<div class="navbar-brand">LOGO</div>

	{{-- Navbar actions --}}
	<div class="navbar-actions">
		{{-- Account dropdown --}}
		<x-dropdown.profile />
	</div>
</nav>
