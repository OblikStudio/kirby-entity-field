<template>
	<k-field v-bind="$props" class="k-structure-field">
		<section :class="[{ open: show }, 'k-structure-form']">
			<div class="k-entity-headline" @click="toggleForm">
				<div class="k-entity-headline-left">
					<k-icon v-if="icon" :type="icon"></k-icon>
					<span>{{ label }}</span>
				</div>
				<div v-if="toggle" class="arrow"></div>
			</div>
			<k-form
				v-show="show"
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
		icon: [Boolean, String],
		value: true
	},
	data() {
		return {
			model: null,
			show: true
		};
	},
	computed: {
		formFields() {
			let fields = {};

			Object.keys(this.fields).forEach(name => {
				let field = this.fields[name];
				field.section = this.name;
				field.endpoints = {
					field: this.endpoints.field + "+" + name,
					section: this.endpoints.section,
					model: this.endpoints.model
				};
				fields[name] = field;
			});

			return fields;
		}
	},
	methods: {
		input() {
			this.$emit("input", this.model);
		},
		toggleForm() {
			if (this.toggle) {
				this.show = !this.show;
			}
		},
		createFields() {
			let data = {};

			Object.keys(this.fields).forEach(fieldName => {
				const field = this.fields[fieldName];
				if (field.default) {
					data[fieldName] = this.$helper.clone(field.default);
				} else {
					data[fieldName] = null;
				}
			});

			return data;
		}
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
			}
		}
	}
};
</script>

<style>
.k-entity-headline {
	height: 50px;
	padding: 0 1.75rem 0 1.5rem;
	display: flex;
	justify-content: space-between;
	align-items: center;
	font-size: 0.85rem;
	font-weight: 500;
	color: #16171a;
	background: rgba(255, 255, 255, 0.15);
	border-bottom: 1px solid transparent;
}
.k-entity-headline-left {
	display: flex;
}
.k-entity-headline-left .k-icon {
	margin-right: 0.65rem;
}
.k-entity-headline-left span:not(.k-icon) {
	opacity: 0.75;
}
.k-entity-headline .arrow {
	width: 10px;
	height: 10px;
	border: 1px solid #aaa;
	transform: rotate(45deg);
	border-width: 0 1px 1px 0;
	margin-bottom: 3px;
}

.k-structure-field[type="entity"] > .k-structure-form {
	box-shadow: none;
}
.k-structure-field[type="entity"] > .k-structure-form.open {
	box-shadow: rgba(22, 23, 26, 0.05) 0px 0px 0px 3px;
}

.k-structure-form.open .k-entity-headline {
	border-bottom: 1px dashed #ccc;
	background: rgba(0, 0, 0, 0.025);
}
.k-structure-form.open .k-entity-headline .arrow {
	margin-top: 6px;
	margin-bottom: 0;
	border-width: 1px 0 0 1px;
}

.k-structure-field[type="entity"] > .k-field-header {
	display: none;
}
</style>
