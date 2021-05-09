<template>
  <fieldset
    :id="id"
    :class="{invalid: this.isError}">
    <legend class="display-1">{{ t(`form.group.${group.label}`) }}</legend>

    <atn-field-wrapper
      v-for="(field, name) in group.fields"
      @update:error="onUpdateError(field.key, $event)"
      @focus="onFocus"
      :ref="'field-'+field.key"
      :key="name"
      :label="field.label"
      :type="field.type"
      :multiple="field.multiple"
      :props="field.props"
      v-model="item[field.key]"/>
  </fieldset>
</template>

<script>
import AtnFieldWrapper from "@/plugins/atn/components/form/AtnFieldWrapper";

export default {
  name: "AtnAdminFormGroup",
  components: {AtnFieldWrapper},
  inject: {
    namespace: {
      default: null
    },
  },
  props: {
    group: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      containsErrors: false,
      containsShouldValidate: false,
      errorBag: {}
    }
  },
  computed: {
    isError() {
      return (this.containsShouldValidate && this.containsErrors)
    }
  },
  watch: {
    containsShouldValidate() {
      const errors = Object.values(this.errorBag).includes(true)
      this.containsErrors = errors
      this.$emit('update:error', errors)
    },
    errorBag: {
      handler(value) {
        if (!this.containsShouldValidate) {
          return
        }
        const errors = Object.values(value).includes(true)
        this.containsErrors = errors
        this.$emit('update:error', errors)

      },
      deep: true
    }
  },
  methods: {
    resetValidation() {
      this.containsShouldValidate = false
    },
    onFocus() {
      this.containsShouldValidate = true
    },
    onUpdateError(key, value) {
      this.$set(this.errorBag, key, value)
    }
  }
}
</script>

<style scoped lang="scss">
@import '~vuetify/src/styles/styles.sass';

fieldset {
  border: solid 1px #e0e0e0;
  padding: 1em !important;
  margin-top: 1em;
  margin-bottom: 2em;
  background-color: white;
  display: flex;
  flex-direction: column;

  legend {
    text-align: center;
    color: #444;
    width: 100%;
    font-weight: 300 !important;
    text-transform: capitalize;
    float: left;
    margin-bottom: 0.5em;
  }

  &.invalid {
    border-color: map-get($red, 'accent-2');

    legend {
      color: map-get($red, 'accent-2');
    }
  }
}
</style>
