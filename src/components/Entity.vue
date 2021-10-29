<template>
  <k-field v-bind="$props" class="k-structure-field">
    <section :class="['k-structure-form', { 'is-open': isOpen }]">
      <div
        :class="['k-entity-header', { 'is-clickable': toggle }]"
        @click="toggleForm"
      >
        <div class="k-entity-header-title">
          <k-icon v-show="icon" :type="icon" />
          <label class="k-field-label">{{ label }}</label>
        </div>
        <k-icon v-show="toggle" :type="isOpen ? 'angle-up' : 'angle-down'" />
      </div>
      <k-form
        v-show="isOpen"
        ref="form"
        v-model="model"
        class="k-structure-form-fields"
        :fields="formFields"
        @input="onInput"
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
    value: {
      type: Boolean,
      default: true,
    },
    name: {
      type: Boolean,
      default: true,
    },
  },

  data() {
    let isOpened =
      localStorage.getItem(`entity-open:${this.endpoints.field}`) !== "false";

    return {
      model: null,
      isOpen: !this.toggle || isOpened,
    };
  },

  computed: {
    id() {
      return `entity-open:${this.endpoints.field}`;
    },

    formFields() {
      return Object.keys(this.fields).reduce((fields, name) => {
        fields[name] = {
          ...this.fields[name],
          section: this.name,
          endpoints: {
            field: this.endpoints.field + "+" + name,
            section: this.endpoints.section,
            model: this.endpoints.model,
          },
        };

        return fields;
      }, {});
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

  methods: {
    onInput() {
      this.$emit("input", this.model);
    },

    toggleForm() {
      if (this.toggle) {
        this.isOpen = !this.isOpen;
        localStorage.setItem(this.id, this.isOpen);
      }
    },

    createFields() {
      return Object.keys(this.fields).reduce((data, fieldName) => {
        const field = this.fields[fieldName];
        data[fieldName] = field.default
          ? this.$helper.clone(field.default)
          : null;
        return data;
      }, {});
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
