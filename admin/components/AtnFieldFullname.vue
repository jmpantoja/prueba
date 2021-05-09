<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-text-field label="Nombre" :rules="constraints" v-model="data.name"/>
    <v-text-field label="Apellidos" :rules="constraints" v-model="data.lastName"/>
  </atn-field>

</template>

<script>
import dataInput from "@/plugins/atn/components/form/mixins/dataInput";
import AtnField from "@/plugins/atn/components/form/AtnField";

export default {
  name: 'AtnFieldFullname',
  components: {AtnField},
  mixins: [dataInput],

  data() {
    return {
      constraints: [
        (v) => {
          v = v || '';
          return v.length > 3 || 'minimo 3'
        }
      ]
    }
  },
  methods: {
    normalize(value) {
      return value || {}
    }
  }
};
</script>

<style lang="scss">

</style>
