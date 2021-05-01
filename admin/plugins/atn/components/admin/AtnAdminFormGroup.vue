<template>
  <fieldset
    :id="id"
    :class="{invalid: this.inValid}">
    <legend class="display-1">{{ t(`form.group.${group.label}`) }}</legend>

    <atn-field-wrapper
      v-for="(field, name) in group.fields"
      @update:error="onUpdateError(field.key, $event)"
      :ref="'field-'+field.key"
      v-model="item[field.key]"
      :key="name"
      :namespace="namespace"
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
    namespace: {
      type: String,
    }
  },
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
  border: solid 1px #e0e0e0;
  padding: 1em  !important;
  margin-top: 1em;
  margin-bottom: 2em;
  background-color: white;

  legend {
    text-align: center;
    color: #444;
    width: 100%;
    font-weight: 300 !important;
    text-transform: capitalize;
    float: left;
    margin-bottom: 1em;
  }

  &.invalid {
    border-color: map-get($red, 'accent-2');

    legend {
      color: map-get($red, 'accent-2');
    }
  }
}
</style>
