<template>

  <v-field v-bind="$props">
    <v-text-field label="Nombre" v-model="data.firstName" :rules="nameRules"/>
    <v-text-field label="Apellidos" v-model="data.lastName" :rules="nameRules"/>
  </v-field>
</template>

<script>
import VField from "~/plugins/admin/components/form/VField";


export default {
  name: 'VPepe',
  components: {VField},
  mixins: [VField],

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
  },
};
</script>

<style lang="scss">

</style>
