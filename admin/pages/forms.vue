<template>
  <v-card elevation="3" class="ma-10">
    <v-card-text>

      <v-form ref="form">
        <v-row>
          <v-col cols="3">
            <v-fullname :label-on-left="true" direction="row" v-model="model.fullName" label="FullName"/>
          </v-col>
          <v-col cols="3">
            <v-fullname :label-on-left="true" direction="column" v-model="model.fullName" label="FullName"/>
          </v-col>
          <v-col cols="3">
            <v-fullname :label-on-left="false" direction="row" v-model="model.fullName" label="FullName"/>
          </v-col>
          <v-col cols="3">
            <v-fullname :label-on-left="false" direction="column" v-model="model.fullName" label="FullName"/>
          </v-col>

        </v-row>
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
      model: {
        fullName: {
          firstName: 'pepe',
          lastName: 'gonzalez'
        }
      }
    }
  },
  methods: {
    submit() {
      this.$refs.form.validate()

    },
    reset() {
      this.$refs.form.resetValidation()
    },

  }
}
</script>
