<template>
	<k-field v-bind="$props" class="k-structure-field">
		<section :class="['k-structure-form', { 'is-open': isOpen }]">
			<div
				:class="['k-entity-header', { 'is-clickable': toggle }]"
				@click="toggleForm"
			>
				<div class="k-entity-header-title">
					<k-icon v-if="icon" :type="icon"></k-icon>
					<label class="k-field-label">{{ label }}</label>
				</div>
				<k-icon
					v-if="toggle"
					:type="isOpen ? 'angle-up' : 'angle-down'"
				></k-icon>
			</div>
			<k-form
				v-show="isOpen"
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
		toggle: Boolean,
		icon: String,
		value: true,
		name: true,
	},
	created() {},
	data() {
		let isOpened =
			localStorage[`entity-open:${this.endpoints.field}`] !== "false";

		return {
			model: null,
			isOpen: !this.toggle || isOpened,
		};
	},
	computed: {
		formFields() {
			let fields = {};

			Object.keys(this.fields).forEach((name) => {
				let field = this.fields[name];
				field.section = this.name;
				field.endpoints = {
					field: this.endpoints.field + "+" + name,
					section: this.endpoints.section,
					model: this.endpoints.model,
				};
				fields[name] = field;
			});

			return fields;
		},
	},
	methods: {
		input() {
			this.$emit("input", this.model);
		},
		toggleForm() {
			if (this.toggle) {
				this.isOpen = !this.isOpen;
				localStorage[`entity-open:${this.endpoints.field}`] = this.isOpen;
			}
		},
		createFields() {
			let data = {};

			Object.keys(this.fields).forEach((fieldName) => {
				const field = this.fields[fieldName];
				if (field.default) {
					data[fieldName] = this.$helper.clone(field.default);
				} else {
					data[fieldName] = null;
				}
			});

			return data;
		},
	},
	watch: {
		value: {
			immediate: true,
			handler(value) {
				if (value) {
					this.model = this.$helper.clone(value);
				} else {
					this.model = this.createFields();
				}
			},
		},
	},
};
</script>

<style scoped>
.k-field-label {
	padding-bottom: 0;
}

.k-structure-form:not(.is-open) {
	border-bottom: 0;
	border-style: dashed;
	box-shadow: none;
}

.k-structure-form.is-open .k-entity-header {
	background: rgb(17, 17, 17, 0.025);
}
</style>

<style>
.k-entity-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 0.75rem 1.5rem;
	border-bottom: 1px dashed #ccc;
	user-select: none;
}

.k-entity-header.is-clickable,
.k-entity-header.is-clickable label {
	cursor: pointer;
}

.k-entity-header-title {
	display: flex;
}

.k-entity-header-title .k-icon {
	margin-right: 0.5rem;
}

.k-structure-field[type="entity"] > .k-field-header {
	display: none;
}
</style>
