<template>
  <dl :class="{'v-fieldset': true, 'error--text': inValid }" :style="{width:field.width}">
    <dd class="label">{{ trans(`form.field.${field.label}`) }}</dd>
    <dt>
      <component
        ref="field"
        @update:error="onInput"
        v-model="data"
        v-bind="field.props"
        :is="field.type"/>
    </dt>
  </dl>
</template>

<script>
export default {
  name: "AtnFieldWrapper",
  props: ['field', 'value'],
  inject: ['trans'],
  computed: {
    data: {
      get() {
        return this.value
      },
      set(value) {
        this.$emit('input', value)
      }
    }
  },
  data() {
    return {
      inValid: false
    }
  },
  methods: {
    onInput(error) {
      this.inValid = error
      this.$emit('update:error', error)
    }
  }
}
</script>

<style scoped lang="scss">

::v-deep dd.label {
  font-size: 1.2em;
  font-weight: 600;
  text-transform: capitalize;
  margin-bottom: 2px;
  //margin-bottom: -7px;
}

</style>
