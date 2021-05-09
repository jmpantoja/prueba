<template>
  <v-input :class="{'atn-field': true, 'error--text':isError  }" v-bind="computedProps" v-on="$listeners">
    <label v-if="label" :class="{'error--text': isError}">{{ t(`form.field.${label}`) }}</label>
    <slot name="default"/>

  </v-input>
</template>

<script>
import {VInput} from 'vuetify/lib';

export default {
  name: "AtnField",
  atn: true,
  extends: VInput,

  inject: {
    form: {
      default: null
    },
    namespace: {
      default: null
    },
  },

  provide() {
    return {
      'form': this
    }
  },
  watch: {
    errorBag: {
      handler(val) {
        const errors = Object.values(val).includes(true)
        this.containsErrors = errors
        this.$emit('update:error', errors)
      },
      deep: true,
      immediate: true,
    },
  },
  data() {
    return {
      containsErrors: false,
      containsShouldValidate: false,
      inputs: {},
      errorBag: {}
    }
  },

  methods: {
    validate(force) {
      return Object.values(this.inputs)
        .filter((input) => {
          return !input.validate(force, input.value)
        })
        .length === 0
    },

    reset() {
      Object.values(this.inputs).forEach(input => input.reset())
      this.containsShouldValidate = false
    },
    resetValidation() {
      Object.values(this.inputs).forEach(input => input.resetValidation())
      this.containsShouldValidate = false
    },

    register(input) {
      if (typeof input.$options._componentTag === "undefined" || input.$options._componentTag === 'v-input') {
        return
      }
      this.inputs[input._uid] = input

      input.$watch('hasError', (value) => {
        this.$set(this.errorBag, input._uid, value)
      })

      input.$watch('shouldValidate', (value) => {
        if (!this.containsShouldValidate && value) {
          this.containsShouldValidate = value
          this.$emit('focus')
        }
      })

    },
    unregister(input) {
      delete this.inputs[input._uid]
    }
  },
  computed: {
    isError() {
      return (this.containsShouldValidate && this.containsErrors)
    },
    hasError() {
      return (
        this.internalErrorMessages.length > 0 ||
        this.errorBucket.length > 0 ||
        this.error ||
        this.containsErrors
      )
    },

    computedProps() {
      return {
        ...this.$props,
        label: '',
        hideDetails: true
      }
    }
  },
}
</script>

<style scoped lang="scss">
.atn-field {
  padding-top: 2em;

  align-items: stretch;

  ::v-deep > div {
    align-items: center;
    margin: 0;
  }

  ::v-deep > .v-input__control > .v-input__slot {
    flex-wrap: wrap;
    justify-content: space-between;

    > label {
      width: 100%;
      font-size: 1.2em;
      font-weight: 400;
      color: #444;

      &:after {
        content: ":";
      }
    }

    > div {
//      flex-grow: 1;
      margin-right: 1em;

      &:last-child {
        margin-right: 0;
      }
    }
  }
}

.atn-field--error {

}

</style>
