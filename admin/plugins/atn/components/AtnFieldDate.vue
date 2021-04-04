<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-text-field type="date" v-model="data" :rules="valid_date"/>
  </atn-field>
</template>

<script>

import AtnField from "./AtnField";

export default {
  name: 'AtnFieldDate',
  components: {AtnField},
  mixins: [AtnField],
  computed: {
    data: {
      get() {
        if (this.lazyValue) {
          return this.$moment(this.lazyValue).format('Y-MM-DD')
        }
        return null;
      },
      set(value) {
        this.$emit('input', value)
      }
    },
  },
  data() {
    return {
      valid_date: [
        v => {
          return this.$moment(v, 'YYYY-MM-DD', true)._isValid || this.$t('rules.date')
        },
        v => {
          return this.$moment(v, 'YYYY-MM-DD', true).month() != 2 || 'mal'
        }
      ]
    }
  },
};
</script>

<style lang="scss">

</style>
