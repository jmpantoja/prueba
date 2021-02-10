<template>

  <v-field v-slot:default="{data}" v-bind="$props">

    <v-text-field label="Nombre" v-model="data.firstName" :rules="nameRules"/>
    <v-text-field label="Apellidos" v-model="data.lastName" :rules="nameRules"/>
  </v-field>

</template>

<script>
import {VInput} from 'vuetify/lib'
import VField from "./VField";


export default {
  name: 'VFullname',
  components: {VField},
  extends: VInput,
  props: ['labelPos', 'direction'],

  data() {
    return {
      nameRules: [
        (v) => {
          return !!v || 'el campo es requerido'
        }
      ]
    }
  }
};
</script>

<style lang="scss">

</style>
