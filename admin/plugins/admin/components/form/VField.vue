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
    data: {
      get() {
        return this.lazyValue
      },
      set(value) {
        this.$emit('input', value)
      }
    },

  },
  mounted() {
    this.$children[0].$children.forEach((input) => {
      
      input.$on('update:error', (error) => {
        this.$set(this.errorBag, input._uid, error)
        const hasErrors = Object.values(this.errorBag).includes(true)

        if (hasErrors !== this.inValid) {
          this.inValid = hasErrors
          this.$emit('update:error', hasErrors)
        }
      })
    })
  }
}
</script>

<style>

</style>
