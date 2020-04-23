<template>
	<k-field v-bind="$props" class="k-structure-field">
		<section class="k-structure-form">
			<k-form
				ref="form"
				class="k-structure-form-fields"
				v-model="model"
				:fields="formFields"
				@input="input"
			/>
		</section>
	</k-field>
</template>

<script>
export default {
	props: {
		endpoints: Object,
		fields: Object,
		label: String,
		value: true
	},
	data () {
		return {
			model: null
		}
	},
	computed: {
		formFields () {
			let fields = {}

			Object.keys(this.fields).forEach(name => {
				let field = this.fields[name]
				field.section = this.name
				field.endpoints = {
					field: this.endpoints.field + '+' + name,
					section: this.endpoints.section,
					model: this.endpoints.model
				}
				fields[name] = field
			})

			return fields
		}
	},
	methods: {
		input () {
			this.$emit('input', this.model)
		},
		createFields () {
			let data = {}

			Object.keys(this.fields).forEach(fieldName => {
				const field = this.fields[fieldName]
				if (field.default) {
					data[fieldName] = this.$helper.clone(field.default)
				} else {
					data[fieldName] = null
				}
			})

			return data
		}
	},
	watch: {
		value: {
			immediate: true,
			handler (value) {
				if (value) {
					this.model = this.$helper.clone(value)
				} else {
					this.model = this.createFields()
				}
			}
		}
	}
}
</script>
