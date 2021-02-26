<template>
  <v-dialog
    eager
    v-model="dialog.opened"
    :width="width"
    @click:outside="onClose"
    @keydown.esc="onClose"
  >
    <v-card :loading="dialog.loading">
      <v-card-title v-if="dialog.title">
        {{ $t(dialog.title) }}
      </v-card-title>
      <v-card-text>
        <slot name="content"/>
      </v-card-text>
      <v-card-actions>
        <v-spacer/>
        <slot name="actions"/>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script lang="ts">
import Dialog from "~/plugins/admin/src/admin/Dialog";

const _ = require('lodash')

export default {
  name: 'CrudDialog',
  props: {
    dialog: {
      type: Dialog,
      required: true
    },
    width: {
      type: Number,
      default() {
        return 520
      }
    },
    title: {
      type: String
    }
  },
  methods: {
    onClose() {
      this.dialog.close()
      return;
    },
    onInput(value) {
      return;
    },
  }
}
</script>


<style lang="scss">
</style>
