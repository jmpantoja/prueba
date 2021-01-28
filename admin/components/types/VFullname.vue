<template>

  <v-field-wrapper v-bind="props" :label="label" :data="data">
    <v-text-field label="Nombre" v-model="data.firstName" :rules="nameRules"/>
    <v-text-field label="Apellidos" v-model="data.lastName" :rules="nameRules"/>
  </v-field-wrapper>

</template>

<script>
import VFieldWrapper from './VFieldWrapper'
import VField from './VField'

export default {
  name: 'VFullname',
  components: {VFieldWrapper},
  extends: VField,
  data() {
    return {
      nameRules: [
        (v) => {
          return !!v || 'el campo es requerido'
        }
      ]
    }
  },
};
</script>

<style lang="scss">
</style>
