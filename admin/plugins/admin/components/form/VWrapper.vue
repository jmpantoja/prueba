<template>
  <v-col v-bind="field.col">
    <dl :class="{'v-fieldset': true, 'error--text': inValid}">
      <dd>{{ field.label }}</dd>
      <dt>
        <component
          @update:error="onInput"
          v-model="data"
          v-bind="field.props"
          :is="field.type"/>
      </dt>
    </dl>
  </v-col>

</template>

<script>

export default {
  name: "VWrapper",
  props: ['field', 'value'],
  computed: {
    data: {
      get(){
        return this.value
      },
      set(value){
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
    }
  }
}
</script>

<style>

</style>
