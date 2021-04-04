<template>
  <v-snackbar
    v-model="flash.visible"
    :color="flash.color"
    :timeout="flash.timeout"
    :multi-line="true"
    top>

    <p class="title" v-html="message"/>
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
import {Flash} from "../src";

export default {
  name: "AtnAdminFlash",
  props: {
    flash: {
      type: Flash,
      required: true
    }
  },
  inject: ['trans'],
  computed: {
    message() {
      if (!this.flash.message) {
        return null
      }
      return this.trans(this.flash.message)
    },

  }
}
</script>

<style scoped>

</style>
