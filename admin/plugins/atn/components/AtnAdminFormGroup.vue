<template>
  <fieldset
    :id="id"
    :class="{invalid: this.inValid}">
    <legend>{{ trans(`form.group.${group.label}`) }}</legend>
    <atn-field-wrapper
      v-for="(field, name) in group.fields"
      @update:error="onUpdateError(field.key, $event)"
      :ref="'field-'+field.key"
      v-model="item[field.key]"
      :key="name"
      :field="field"/>
  </fieldset>
</template>

<script>
export default {
  name: "AtnAdminFormGroup",
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
    },
  },
  inject: ['trans'],
  data() {
    return {
      inValid: false,
      errorBag: {}
    }
  },
  watch: {
    errorBag: {
      handler(errors) {
        const hasError = Object.values(errors).includes(true)
        if (hasError !== this.inValid) {
          this.inValid = hasError
          this.$emit('update:error', hasError)
        }
      },
      deep: true
    }
  },
  methods: {
    onUpdateError(key, value) {
      this.$set(this.errorBag, key, value)
    }
  }

}
</script>

<style scoped lang="scss">
@import '~vuetify/src/styles/styles.sass';

fieldset {
  border: solid lightgray 1px;
  padding: 2em !important;
  margin-bottom: 2em;


  legend {
    margin-left: -8px;
    font-size: 1.6em;
    font-weight: 500;
    padding: 0 10px 0 5px;
    text-transform: capitalize;
    font-family: "Roboto";
  }

  &.invalid {
    border-color: map-get($red, 'accent-2');

    legend {
      color: map-get($red, 'accent-2');
    }
  }
}
</style>
