<form
	x-data="companyProjectFormUpdateComponent"
    id="{{ $formId['UPDATE_COMPANY_PROJECT_FORM'] }}"
	class="service-form"
	wire:submit.prevent="submit"
>
	@include('admin::company-projects.partials.company-project-form')

	<div class="modal-actions">
		<x-button.outline
			class="modal-close"
			label="Cancel"
			:data-custom-close="$modal['UPDATE_COMPANY_PROJECT_MODAL']"
		/>

		<x-button.main
			label="Submit"
			wire:target="submit"
			wire:loading.class="spinner"
			wire:attr="disabled"
		/>
	</div>
</form>
