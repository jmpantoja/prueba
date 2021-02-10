<template>
  <v-card elevation="3" class="ma-10">
    <v-card-text>
      <v-form ref="form" v-model="valid">
        VALID: {{ valid }}

        <v-row v-if="true">
          <v-col cols="12">
            <v-hola :label-width="6" v-model="model.name" label="Hola"/>
            {{ model.name }}
          </v-col>
        </v-row>

        <v-row v-if="false">
          <v-col cols="3">
            <v-fullname label-pos="top" direction="row" v-model="model.fullName" label="FullName"/>
          </v-col>
          <v-col cols="3">
            <v-fullname label-pos="top" direction="column" v-model="model.fullName" label="FullName"/>
          </v-col>
          <v-col cols="3">
            <v-fullname label-pos="left" direction="row" v-model="model.fullName" label="FullName"/>
          </v-col>
          <v-col cols="3">
            <v-fullname label-pos="left" direction="column" v-model="model.fullName" label="FullName"/>
          </v-col>
        </v-row>


        {{ model.fullName }}

      </v-form>

    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn @click="submit">enviar</v-btn>
      <v-btn @click="reset">reset</v-btn>

    </v-card-actions>
  </v-card>
</template>

<script lang="ts">

export default {

  data() {
    return {
      valid: true,
      model: {
        name: 'juan',
        fullName: {
          firstName: 'pepe',
          lastName: 'gonzalez'
        }
      }
    }
  },
  methods: {
    submit() {
      const valid = this.$refs.form.validate()
    },
    reset() {
      this.$refs.form.resetValidation()
    },

  }
}
</script>
