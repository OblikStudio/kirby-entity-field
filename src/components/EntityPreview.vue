<template>
	<div class="k-bubbles-field-preview">
		<k-bubbles :bubbles="bubbles" />
	</div>
</template>

<script>
export default {
	props: {
		value: Object,
		column: Object,
		field: Object,
		row: Object,
	},
	computed: {
		bubbles() {
			let fields = Object.keys(this.field.fields);

			return [
				{
					text: `${fields.length} ${this.$t(
						`oblik.entity-field.${fields.length === 1 ? "field" : "fields"}`
					)}`,
				},
			];
		},
	},
};
</script>
