<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-text-field type="date" v-model="data" :rules="valid_date"/>
  </atn-field>
</template>

<script>

import dataInput from "@/plugins/atn/components/form/mixins/dataInput";

export default {
  name: 'AtnFieldDate',
  mixins: [dataInput],
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
