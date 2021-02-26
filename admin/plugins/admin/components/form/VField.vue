<template>
  <v-input v-bind="$props" :error="inValid">
    <slot/>
  </v-input>
</template>

<script>
import {VInput} from 'vuetify/lib'

export default {
  name: "VField",

  mixins: [VInput],
  data() {
    return {
      inValid: false,
      errorBag: {}
    }
  },
  computed: {
    data() {
      return this.lazyValue
    }
  },
  watch: {
    errorBag: {
      handler(val) {
        const errors = Object.values(val).includes(true)
        this.$emit('update:error', errors)
        this.inValid = errors
      },
      deep: true,
      immediate: true,
    },
  },
  mounted() {
    this.$children[0].$children.forEach((input) => {

      input.$on('input', (error) => {
        this.$emit('input', this.data)
      })

      input.$on('update:error', (error) => {
        this.$set(this.errorBag, input._uid, error)
      })
    })
  }
}
</script>

<style>

</style>
