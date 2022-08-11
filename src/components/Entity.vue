<template>
	<k-field v-bind="$props" :class="['k-structure-form', { 'is-open': isOpen }]">
		<section>
			<component
				class="k-entity-header"
				:is="toggle ? 'button' : 'div'"
				:type="toggle ? 'button' : null"
				@click="toggle ? toggleForm() : null"
			>
				<div class="k-entity-header-title">
					<k-icon v-if="icon" :type="icon" />
					<label class="k-field-label">{{ label }}</label>
				</div>
				<k-icon v-if="toggle" :type="isOpen ? 'angle-up' : 'angle-down'" />
			</component>
			<k-form
				ref="form"
				class="k-structure-form-fields"
				v-show="isOpen"
				:fields="formFields"
				:value="value"
				@input="$emit('input', $event)"
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
	data() {
		let isOpened =
			localStorage[`entity-open:${this.endpoints.field}`] !== "false";

		return {
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
		toggleForm() {
			this.isOpen = !this.isOpen;
			localStorage[`entity-open:${this.endpoints.field}`] = this.isOpen;
		},
	},
};
</script>

<style scoped>
.k-structure-form > :deep(.k-field-header) {
	display: none;
}

.k-structure-form.is-open > section > .k-entity-header {
	background: rgb(17, 17, 17, 0.025);
}

.k-structure-form:not(.is-open) :deep(section) {
	box-shadow: none;
	border-style: dashed;
	border-bottom: none;
}

.k-field-label {
	padding-bottom: 0;
}
</style>

<style>
.k-entity-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	width: 100%;
	padding: var(--spacing-3) var(--spacing-6);
	border-bottom: 1px dashed var(--color-border);
	user-select: none;
}

button.k-entity-header label {
	cursor: pointer;
}

.k-entity-header-title {
	display: flex;
}

.k-entity-header-title .k-icon {
	margin-right: var(--spacing-2);
}
</style>
