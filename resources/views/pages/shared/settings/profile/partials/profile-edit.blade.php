{{-- Profile Card Form --}}
<div class="card">
    <div class="card-profile">
        <div>
            <div class="card-profile-info">
                <div class="card-profile-img">
                    <img src="{{ $avatar }}" />
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
