<template>
  <v-input v-bind="$props" :error="inValid">
    <slot/>
  </v-input>
</template>

<script>
import {VInput} from 'vuetify/lib'

export default {
  name: "AtnField",

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
  methods: {
    validateAll() {
      this.$children[0].$children.forEach((input) => {
        if (!input.validate) {
          return
        }
        this.$set(this.errorBag, input._uid, !input.validate(true))
        const hasErrors = Object.values(this.errorBag).includes(true)

        if (hasErrors !== this.inValid) {
          this.inValid = hasErrors
          this.$emit('update:error', hasErrors)
        }
      })
    }
  },
  mounted() {
    this.$children[0].$children.forEach((input) => {

      input.$on('input', () => {
        this.validateAll()
      })
    })
  }
}
</script>

<style lang="scss" scoped>

::v-deep .v-input__slot .row {
  //padding: 0 !important;
  //
  //.col {
  //  padding-top: 0 !important;
  //  padding-bottom: 0 !important;
  //}
}

</style>

