import Entity from "./components/Entity.vue";
import EntityPreview from "./components/EntityPreview.vue";

panel.plugin("oblik/entity-field", {
	fields: {
		entity: Entity,
	},
	components: {
		"k-entity-field-preview": EntityPreview,
	},
});
