<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-row>
      <v-col>
        <v-text-field :label="trans('form.field.firstName')" v-model="data.firstName" :rules="nameRules"/>
      </v-col>
      <v-col>
        <v-text-field :label="trans('form.field.lastName')" v-model="data.lastName" :rules="nameRules"/>
      </v-col>
    </v-row>
  </atn-field>
</template>

<script>

import AtnField from "../plugins/atn/components/AtnField";

export default {
  name: 'AtnFieldFullname',
  components: {AtnField},
  mixins: [AtnField],
  inject: ['trans'],
  data() {
    return {
      nameRules: [
        (v) => {
          return !!v || 'el campo es requerido'
        },
        (v) => {
          v = v || ''
          return !(v.length < 10) || 'demasiado corto (borrame)'
        }
      ]
    }
  }
};
</script>

<style lang="scss">

</style>
