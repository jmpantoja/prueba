import {VInput} from 'vuetify/lib'

export default VInput.extend({
  name: "dataInput",
  atn: true,
  provide() {
    return {
      dataInput: this
    }
  },
  created() {
    this.$emit('input', this.normalize(this.value))
  },
  data() {
    return {
      innerField: null,
    }
  },
  computed: {
    data: {
      get() {
        return this.normalize(this.value)
      },
      set(value) {
        this.$emit('input', value)
      }
    },
    hasError() {
      return !this.valid
    }
  },
  methods: {
    normalize(data) {
      return data;
    }
  }
})
