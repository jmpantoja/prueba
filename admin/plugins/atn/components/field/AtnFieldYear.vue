<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-text-field v-model.number="data" v-mask="'####'" placeholder="1980" :rules="constraints"/>
  </atn-field>
</template>

<script>
import AtnField from "@/plugins/atn/components/field/AtnField";

const _ = require('lodash')

export default {
  name: "AtnFieldYear",
  components: {AtnField},
  mixins: [AtnField],
  props: {
    min: {
      type: Number,
    },
    max: {
      type: Number,
    }
  },
  data() {
    return {
      constraints: [
        (v) => {
          const min = this.min
          const max = this.max
          if (min && max) {
            return v >= this.min && v <= this.max || this.t('rules.year', {min: this.min, max: this.max})
          }

          if (min) {
            return v >= this.min || this.t('rules.year', {min: this.min})
          }

          if (max) {
            return v <= this.max || this.t('rules.year', {max: this.max})
          }
        },
      ]
    }
  }
}
</script>

<style scoped>
</style>



