<template>
	<k-field v-bind="$props" class="k-structure-field">
		<section class="k-structure-form">
			<k-form
				ref="form"
				:fields="formFields"
				v-model="model"
				class="k-structure-form-fields"
				@input="input"
			/>
		</section>
	</k-field>
</template>

<script>
import { cloneDeep } from 'lodash-es'

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
			var fields = {}

			Object.keys(this.fields).forEach(name => {
				var field = this.fields[name]
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
			var data = {}

			Object.keys(this.fields).forEach(fieldName => {
				const field = this.fields[fieldName]
				if (field.default) {
					data[fieldName] = cloneDeep(field.default)
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
					this.model = cloneDeep(value)
				} else {
					this.model = this.createFields()
				}
			}
		}
	}
}
</script>
