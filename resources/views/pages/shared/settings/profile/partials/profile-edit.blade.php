{{-- Profile Card Form --}}
<div class="card">
    <div class="card-profile">
        <div>
            <div class="card-profile-info">
                <div class="card-profile-img">
                    <x-asset.img
                        folder="mockups"
                        img="profile.jpg"
                    />
                </div>

                <header>
                    {{ $fullName }}
                </header>

                {{-- Position --}}
                <x-form.input
                    label="Position"
                    wire:model="position"
                    :error="$errors->first('position')"
                />

                {{-- Company Name --}}
                <x-form.input
                    label="Company Name"
                    wire:model="companyName"
                    :error="$errors->first('companyName')"
                />
            </div>
        </div>

        {{-- Save / Cancel --}}
        <div class="form-actions">
            <x-button.main
                label="Save"
                wire:loading.class="spinner"
                wire:target="submit"
                wire:attr="disabled"
            >
            </x-button.main>

            <x-button.outline
                label="Cancel"
                @click="cancelEdit"
            >
            </x-button.outline>
        </div>
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
            <x-form.input
                label="First name"
                wire:model="firstName"
                minlength="3"
                required
                :error="$errors->first('firstName')"
            />

            {{-- Last Name --}}
            <x-form.input
                label="Last name"
                wire:model="lastName"
                minlength="3"
                required
                :error="$errors->first('lastName')"
            />
        </div>

        {{-- Phone --}}
        <div class="peronsal-content">
            <x-form.input
                type="tel"
                label="Phone"
                wire:model="phone"
                :error="$errors->first('phone')"
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
            <x-form.input
                label="Country"
                wire:model="country"
                :error="$errors->first('country')"
            />

            {{-- City --}}
            <x-form.input
                label="City"
                wire:model="city"
                :error="$errors->first('city')"
            />
        </div>

        {{-- Postal Code --}}
        <div class="peronsal-content">
            <x-form.input
                type="number"
                label="Postal Code"
                wire:model="postalCode"
                :error="$errors->first('postalCode')"
            />
        </div>
    </div>
</div>
