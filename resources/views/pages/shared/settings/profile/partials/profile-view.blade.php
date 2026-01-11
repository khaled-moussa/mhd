{{-- Profile Card --}}
<div class="card">
	<div class="card-profile">
		<div>
			<div class="card-profile-img">
				<x-asset.img
					folder="mockups"
					img="profile.jpg"
				/>
			</div>

			<div class="card-profile-info">
				<header>
					{{ $fullName }}
				</header>

				{{-- Position --}}
				<p class="description">
					{{ $position ?? 'No Position' }}
				</p>

				{{-- Company Name --}}
				<p class="sub-description">
					{{ $companyName ?? 'No Company' }}
				</p>
			</div>
		</div>

		{{-- Edit Button --}}
		<x-button.outline
			label="Edit"
			@click="editUser"
		>
			<i class="fi fi-rr-pencil"></i>
		</x-button.outline>
	</div>
</div>

{{-- Personal Information --}}
<div class="card">
	<div class="card-header">
		<header>Personal Information</header>
	</div>

	<div class="personal-info">
		{{-- First Row --}}
		<div class="peronsal-content">

			{{-- First Name --}}
			<x-label.info
				label="First name"
				:description="$firstName"
			/>

			{{-- Last Name --}}
			<x-label.info
				label="Last name"
				:description="$lastName"
			/>
		</div>

		{{-- Phone --}}
		<div class="peronsal-content">
			<x-label.info
				label="Phone"
				:description="$phone"
			/>
		</div>
	</div>
</div>

{{-- Address --}}
<div class="card">
	<div class="card-header">
		<header>Address</header>
	</div>

	<div class="personal-info">
		{{-- Country + City --}}
		<div class="peronsal-content">

			{{-- Country --}}
			<x-label.info
				label="Country"
				:description="$country"
			/>

			{{-- City --}}
			<x-label.info
				label="City"
				:description="$city"
			/>

		</div>

		{{-- Postal Code --}}
		<div class="peronsal-content">
			<x-label.info
				label="Postal Code"
				:description="$postalCode"
			/>
		</div>
	</div>
</div>
