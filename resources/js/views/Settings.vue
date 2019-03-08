<template>
	<loading-view :loading="loading">
		<form v-if="fields" @submit.prevent="createResource" autocomplete="off">

			<card class="overflow-hidden">

				<!-- Validation Errors -->
				<validation-errors :errors="validationErrors"/>

				<!-- Fields -->
				<div v-for="field in fields">
					<component
						:is="'form-' + field.component"
						:errors="validationErrors"
						resource-name="settings"
						:field="field"
					/>
				</div>

			</card>

			<card class="mt-6">
				<!-- Create Button -->
				<div class="flex px-8 py-6">

					<progress-button
						dusk="create-button"
						type="submit"
						:processing="submittedViaCreateResource"
					>
						{{ __('Save') }}
					</progress-button>
				</div>
			</card>
		</form>
	</loading-view>
</template>

<script>
import { Errors, Minimum, InteractsWithResourceInformation } from 'ofcold-script'

export default {
	mixins: [InteractsWithResourceInformation],
	props: {
		bundleName: {
			type: String,
			default: ''
		}
	},

	data: () => ({
		loading: true,
		submittedViaCreateResource: false,
		fields: [],
		validationErrors: new Errors(),
	}),

	async created() {
		this.getFields()
	},

	methods: {
		/**
		 * Get the available fields for the resource.
		 */
		async getFields() {
			this.fields = []

			const { data: fields } = await Ofcold.request().get(`/admin/settings/${this.bundleName}`)

			this.fields = fields
			this.loading = false
		},

		/**
		 * Create a new resource instance using the provided data.
		 */
		async createResource() {
			this.submittedViaCreateResource = true

			try {
				const response = await this.createRequest()

				this.submittedViaCreateResource = false

				this.$toasted.show(
					this.__('Save successfully!'),
					{ type: 'success' }
				)

			}
			catch (error) {
				this.submittedViaCreateResource = false

				if (error.response.status == 422) {
					this.validationErrors = new Errors(error.response.data.errors)
				}
			}
		},

		/**
		 * Send a create request for this resource
		 */
		createRequest() {
			return Ofcold.request().post(
				`/admin/settings/${this.bundleName}`,
				this.createResourceFormData()
			)
		},

		/**
		 * Create the form data for creating the resource.
		 */
		createResourceFormData() {
			return _.tap(new FormData(), formData => {
				_.each(this.fields, field => {
					field.fill(formData)
				})
			})
		},
	},

}
</script>
