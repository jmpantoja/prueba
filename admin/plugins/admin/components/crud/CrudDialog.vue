<template>
  <div>
    <v-dialog v-model="dialog.opened" :width="width">
      <v-card :loading="dialog.loading">
        <v-card-title v-if="dialog.title">
          {{ dialog.title }}
        </v-card-title>
        <v-card-text>
          {{ dialog.text }}
        </v-card-text>
        <v-card-actions>
          <v-spacer/>

          <slot name="actions">
            <slot name="action_cancel">
              <v-btn color="primary" text @click="onCancel()">
                {{ $t('form.cancel') }}
              </v-btn>
            </slot>
            <slot name="action_ok">
              <v-btn color="primary" text @click="onOk()">
                {{ $t('form.ok') }}
              </v-btn>
            </slot>
          </slot>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
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
      onOk(item: object) {
        this.dialog.ok()
        return;
      },
      onCancel(item: object) {
        this.dialog.close()
        return;
      }
    }
  }
}
</script>


<style lang="scss">
.grid-menu {

  .menu {
    text-align: center;
    padding-top: 1em;
  }

  .v-data-table {
    margin-left: 56px;
  }

  .crud-grid-panel {
    margin-left: 56px;
    box-shadow: none;
  }

  .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }
}

</style>
