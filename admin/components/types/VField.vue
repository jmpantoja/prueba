<script>
import {VInput} from 'vuetify/lib'

const _ = require('lodash')

export default {
  name: 'VField',
  extends: VInput,

  props: {
    labelOnLeft: {
      type: Boolean,
      default() {
        return false
      }
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
      data: this.value
    }
  },
  computed: {
    props() {
      let props = _.cloneDeep(this.$props)
      _.unset(props, 'value')

      return {
        ...props
      }
    }
  },
  methods: {
    validate() {

      if (this.$children[0]) {
        this.valid = this.$children[0].validate()
      }
      return this.valid

    },
    resetValidation() {
      if (this.$children[0]) {
        this.$children[0].resetValidation()
      }
    }
  }
};
</script>
