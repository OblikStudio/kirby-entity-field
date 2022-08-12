import EntityField from "./components/EntityField.vue";
import EntityPreview from "./components/EntityPreview.vue";

panel.plugin("oblik/entity-field", {
	fields: {
		entity: EntityField,
	},
	components: {
		"k-entity-field-preview": EntityPreview,
	},
});
