<template>

  <v-field v-slot:default="{data}" v-bind="$props" >
    <v-text-field label="Nombre" v-model="data" :rules="nameRules"/>
  </v-field>

</template>

<script>
import {VTextField} from 'vuetify/lib'
import VField from "./VField";


export default {
  name: 'VHola',
  components: {VField},
  extends: VTextField,
  props: ['labelWidth', 'direction'],

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
