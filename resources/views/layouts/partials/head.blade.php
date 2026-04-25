{{-- layouts/partials/head.blade.php --}}

<head>
	{{-- Meta --}}
	<meta charset="utf-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1"
	>

	{{-- Title --}}
	<title>
		@yield('title', config('app.name'))
	</title>

	{{-- Vendor / External --}}
	<script
		src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"
		defer
	></script>

	{{-- Favicon --}}
	<link
		rel="icon"
		href="{{ asset('favicon.ico') }}"
	>

	{{-- Fonts --}}
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
		rel="stylesheet"
	>

	{{-- App Assets --}}
	@vite(['resources/css/app.css', 'resources/js/app.js'])

	{{-- Page-specific head --}}
	@stack('head')

	{{-- Livewire --}}
	@livewireStyles
</head>
