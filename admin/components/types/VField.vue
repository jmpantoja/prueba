<template>

  <v-input :class="classes" v-bind="$props" :error="!valid">

    <span v-if="labelWidth>=1" :style="labelStyle" slot="label">{{ label }}</span>

    <div class="v-field__fields">
      <slot :data.sync="data"/>
    </div>
  </v-input>

</template>

<script>
import {VInput} from 'vuetify/lib'

const _ = require('lodash')

export default {
  name: 'VField',
  extends: VInput,

  props: {
    labelWidth: {
      type: Number,
      default: -1
    },
    direction: {
      type: String,
      default: 'row',
      validator: (value) => {
        return ['row', 'column'].indexOf(value) > -1
      }
    }
  },
  data() {
    return {
      valid: true,
      errorBag: {},
      data: this.value
    }
  },
  computed: {
    labelStyle() {
      console.log(this.labelWidth)
      return {
        display: 'inline-block',
        width: `${this.labelWidth}em`
      }
    },
    classes() {
      return {
        'v-field': true,
        'label-on-left': this.labelWidth >= 1,
        'label-on-top': this.labelWidth < 1,
        'direction-column': this.direction === 'column',
        'direction-row': this.direction === 'row'
      }
    }
  },
  watch: {
    errorBag: {
      handler(val) {
        const errors = Object.values(val).includes(true)
        this.valid = !errors
      },
      deep: true,
      immediate: true,
    },
  },

  mounted() {
    const isObject = _.isObject(this.data)


    this.$on('input', (value) => {
      this.$parent.$emit('input', value)
    })

    this.$children[0].$children.forEach(child => {
      child.$on('input', (value) => {
        const response = isObject ? this.data : value
        this.$emit('input', response)
      })

      child.$on('update:error', (error) => {
        this.$set(this.errorBag, child._uid, error)
      })


    })
  }
};
</script>

<style lang="scss" scoped>
@import '~vuetify/src/components/VInput/variables';

.v-field {

  ::v-deep > .v-input__control {
    > .v-input__slot {
      align-items: normal;

      > .v-label {
        margin-top: 3px;
        font-weight: bold;

        span:after {
          content: ":";
        }
      }
    }
  }
}

.v-field.label-on-top {
  ::v-deep > .v-input__control {
    > .v-input__slot {
      flex-direction: column;

      > .v-label {
        margin-bottom: 1em
      }
    }
  }
}

.v-field.label-on-left {
  ::v-deep > .v-input__control {
    > .v-input__slot {
      flex-direction: row;

      > .v-label {
        //   width: 9em;
        text-align: right;
        margin-right: 1em;
      }

      > .v-field__fields {
        flex-grow: 1;
      }
    }
  }
}

.v-field.direction-row {
  ::v-deep > .v-input__control {
    > .v-input__slot {
      > .v-field__fields {
        display: flex;

        > div.v-input {
          margin-right: 1em
        }
      }
    }
  }
}
</style>
