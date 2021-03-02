<template>
  <admin-overlay
    v-model="dialog.visible"
    :title="title"
    :width="dialog.width"
  >
    <template slot="content">
      <p class="text-subtitle-1" v-html="$t(dialog.message)"/>
    </template>
    <template slot="actions:right">
      <v-btn
        @click="onCancel"
        text
        color="primary">
        {{ $t('dialog.no') }}
      </v-btn>

      <v-btn
        @click="onConfirm"
        text
        color="primary">
        {{ $t('dialog.yes') }}
      </v-btn>

    </template>
  </admin-overlay>
</template>

<script>
import {Dialog} from "../../src/admin";
import AdminOverlay from "./AdminOverlay";

export default {
  name: "AdminDialog",
  components: {AdminOverlay},
  props: {
    dialog: {
      type: Dialog,
      required: true
    }
  },
  computed: {
    title() {
      return this.$t(this.dialog.title)
    }
  },
  methods: {
    onCancel() {
      this.dialog.visible = false
    },
    onConfirm() {
      this.dialog.confirm()
    }
  }
}
</script>

<style scoped>

</style>
