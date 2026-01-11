{{-- Sidebar --}}
<aside
	id="sidebar"
	class="sidebar"
>
	{{-- Brand --}}
	<div class="sidebar-brand">
		<div class="logo"></div>
		{{-- <span class="brand-name">BRAND</span> --}}
	</div>

	{{-- Toggle --}}
	<x-button.outline
		id="sidebar-expand-btn"
		class="toggle-btn"
	>
		<i class="fi fi-sr-menu-burger"></i>
	</x-button.outline>

	<div class="sidebar-menu-scroll">
		{{-- Main Menu --}}
		<ul class="sidebar-menu">
			@foreach ($primarySidebarItems as $item)
				<x-navigation.sidebar.item
					:label="$item->label"
					:icon="$item->icon"
					:route="$item->url()"
					:active="$item->isActive()"
				/>
			@endforeach
		</ul>

		{{-- Secondary Menu --}}
		<ul class="sidebar-menu">
			@foreach ($secondarySidebarItems as $item)
				<x-navigation.sidebar.item
					:label="$item->label"
					:icon="$item->icon"
					:route="$item->url()"
					:active="$item->isActive()"
				/>
			@endforeach

			{{-- Logout --}}
			<li>
				<form
					action="{{ route('auth.logout') }}"
					method="POST"
				>
					@csrf

					<x-button.icon
						type="submit"
						label="Logout"
						icon="fi fi-sr-sign-out-alt"
					/>
				</form>
			</li>
		</ul>
	</div>
</aside>
