<template>
  <dl :class="{'v-fieldset': true, 'error--text': inValid }" :style="{width:field.width}">
    <dd class="label">{{ t(`form.field.${field.label}`) }}</dd>
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
  props: ['field', 'value', 'namespace'],
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


dl {
  margin-top: 2em;
  min-height: 100px;

  dd.label {
    //min-width: 150px;
    font-size: 1.3em;
    font-weight: 500;
    text-transform: capitalize;
    padding-right: 0.5em;
    color: #444;

    &:after{
      content: ':';
    }
  }
}

</style>
