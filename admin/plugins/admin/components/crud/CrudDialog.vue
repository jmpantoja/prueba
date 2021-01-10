<template>
    <v-dialog v-model="dialog.opened" :width="width">
      <v-card :loading="dialog.loading">
        <v-card-title v-if="dialog.title">
          {{ $t(dialog.title) }}
        </v-card-title>
        <v-card-text>
          {{ $t(dialog.text) }}
        </v-card-text>
        <v-card-actions>
          <v-spacer/>

          <slot name="actions">
            <slot name="action_cancel">
              <v-btn color="primary" text @click="onNo()">
                {{ $t('dialog.no') }}
              </v-btn>
            </slot>
            <slot name="action_ok">
              <v-btn color="primary" text @click="onYes()">
                {{ $t('dialog.yes') }}
              </v-btn>
            </slot>
          </slot>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script lang="ts">
import {Crud} from "~/plugins/admin/types";

const _ = require('lodash')

export default {
  name: 'CrudDialog',
  props: {
    crud: {
      type: Crud,
      required: true
    },
    width: {
      type: Number,
      default() {
        return 500
      }
    },
    title: {
      type: String
    }
  },
  setup(props: { crud: Crud }) {
    const dialog = props.crud.dialog
    return {
      dialog: dialog,
      onYes(item: object) {
        this.dialog.ok()
        return;
      },
      onNo(item: object) {
        this.dialog.close()
        return;
      }
    }
  }
}
</script>


<style lang="scss">
</style>
