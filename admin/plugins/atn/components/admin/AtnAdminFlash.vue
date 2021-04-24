<template>
  <v-snackbar
    v-model="flash.visible"
    :color="flash.color"
    :timeout="flash.timeout"
    :multi-line="true"
    top>

    <p class="title" v-if="flash.message" v-html="t(flash.message, flash.params)"/>
    <p class="text-body-1" v-html="flash.reason"/>

    <template v-slot:action="{ attrs }">
      <v-btn
        icon
        v-bind="attrs"
        @click="flash.visible = false"
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
import {Flash} from "../../src";

export default {
  name: "AtnAdminFlash",
  props: {
    flash: {
      type: Flash,
      required: true
    }
  },
  computed: {
    namespace() {
      return this.flash.namespace
    },

  }
}
</script>

<style scoped>

</style>
