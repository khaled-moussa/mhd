<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@include('layouts.partials.head')
	</head>

	<body class="loader">
		<div class="app-shell">
			{{-- Navigation --}}
			<x-navigation.sidebar.app />
			<x-navigation.navbar.app />

			{{-- Main Content --}}
			<main class="app-content">
				@yield('component')
			</main>
		</div>

		@include('layouts.partials.scripts')
	</body>
</html>
