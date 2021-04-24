<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-row>
      <v-col>
        <v-text-field :label="$t('form.field.firstName')" v-model="data.firstName" :rules="nameRules"/>
      </v-col>
      <v-col>
        <v-text-field :label="$t('form.field.lastName')" v-model="data.lastName" :rules="nameRules"/>
      </v-col>
    </v-row>
  </atn-field>
</template>

<script>

import AtnField from "../plugins/atn/components/field/AtnField";

export default {
  name: 'AtnFieldFullname',
  components: {AtnField},
  mixins: [AtnField],
  data() {
    return {
      nameRules: [
        (v) => {
          return !!v || 'el campo es requerido'
        },
        (v) => {
          v = v || ''
          return !(v.length < 3) || 'Al menos 3 letras'
        }
      ]
    }
  }
};
</script>

<style lang="scss">

</style>
