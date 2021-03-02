<template>
  <v-snackbar
    v-model="flash.visible"
    :color="flash.color"
    :timeout="2000"
    :multi-line="true"
    top
  >
    <p class="text-h6" v-html="$t(flash.message)"/>
    <p v-if="flash.reason" class="text-body-1" v-html="flash.reason"/>

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
import Flash from "../../src/admin/Flash";

export default {
  name: "AdminFlash",
  props: {
    flash: {
      type: Flash,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
