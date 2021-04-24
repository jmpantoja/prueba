<template>
  <atn-modal
    v-model="dialog.visible"
    :title="t(dialog.title, dialog.params)"
    :width="dialog.width"
  >
    <template slot="content">
      <p v-if="dialog.message" class="text-subtitle-1" v-html="t(dialog.message, dialog.params)"/>
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
  </atn-modal>
</template>

<script>

import AtnModal from "./AtnModal";
import {Dialog} from "../../src";

export default {
  name: "AtnAdminDialog",
  components: {AtnModal},
  props: {
    dialog: {
      type: Dialog,
      required: true
    }
  },
  methods: {
    onCancel() {
      this.dialog.visible = false
    },
    onConfirm() {
      this.dialog.confirm()
    }
  },
  computed: {
    namespace() {
      return this.dialog.namespace
    }
  }
}
</script>

<style scoped>

</style>
