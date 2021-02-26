<template>

  <v-field v-bind="$props">
    <v-text-field type="date" v-model="data" :rules="valid_date"/>
  </v-field>
</template>

<script>
import VField from "~/plugins/admin/components/form/VField";


export default {
  name: 'VDate',
  components: {VField},
  mixins: [VField],
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
        }
      ]
    }
  },
};
</script>

<style lang="scss">

</style>
