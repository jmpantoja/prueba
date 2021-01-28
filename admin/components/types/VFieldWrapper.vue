<template>
  <v-input :class="classes" v-bind="$props" :error="!valid">
    <div class="v-field-wrapper__field">
      <slot/>
    </div>
  </v-input>
</template>

<script>
import {VForm} from 'vuetify/lib'


export default {
  name: 'VFieldWrapper',
  extends: VForm,

  props: {
    appendIcon: String,
    backgroundColor: {
      type: String,
      default: '',
    },
    dense: Boolean,
    height: [Number, String],
    hideDetails: [Boolean, String],
    hint: String,
    id: String,
    label: String,
    loading: Boolean,
    persistentHint: Boolean,
    prependIcon: String,
    data: [Boolean, String, Number, Object],
    labelOnLeft: {
      type: Boolean,
      default() {
        return false
      }
    },
    direction: {
      type: String,
      default: 'column',
      validator: (value) => {
        return ['row', 'column'].indexOf(value) > -1
      }
    }
  },

  data() {
    return {
      local: this.data,
      valid: true,
      classes: {
        'v-field-wrapper': true,
        'label-on-left': this.labelOnLeft,
        'label-on-top': !this.labelOnLeft,
        'direction-column': this.direction === 'column',
        'direction-row': this.direction === 'row'
      }
    };
  },
  watch: {
    local() {
      this.$parent.$emit('input', this.local)
    },
    data(value) {
      this.local = value
    }
  },
  mounted() {
    const wrapper = this.inputs.find((input) => {
      return input._uid === this._uid + 1
    })

    this.unregister(wrapper)
  },
  created() {
    this.$on('input', (value) => {
      this.valid = value
    })
  }

};
</script>

<style lang="scss">
@import '~vuetify/src/components/VInput/variables';

.v-field-wrapper {
  > .v-input__control {
    > .v-input__slot {
      align-items: normal;

      > .v-label {
        margin-top: 3px;
        font-weight: bold;

        &:after {
          content: ":";
        }
      }
    }
  }
}


.v-field-wrapper.label-on-top {
  > .v-input__control {
    > .v-input__slot {
      flex-direction: column;

      > .v-label {
        margin-bottom: 1em
      }
    }
  }
}

.v-field-wrapper.label-on-left {
  > .v-input__control {
    > .v-input__slot {
      flex-direction: row;

      > .v-label {
        width: 9em;
        text-align: right;
        margin-right: 1em;
      }

      > .v-field-wrapper__field {
        flex-grow: 1;
      }

    }
  }
}

.v-field-wrapper.direction-row {

  > .v-input__control {
    > .v-input__slot {
      > .v-field-wrapper__field {
        display: flex;

        > div.v-input {
          margin-right: 1em
        }

      }
    }
  }


}


</style>
