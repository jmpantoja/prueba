<template>
  <crud-dialog :dialog="dialog">
    <template slot="content">
      {{ $t(dialog.text) }}
    </template>

    <template slot="actions">
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

    </template>
  </crud-dialog>

</template>
<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import CrudDialog from "~/plugins/admin/components/crud/CrudDialog.vue";

const _ = require('lodash')

export default {
  name: 'CrudDeleteDialog',
  components: {CrudDialog},
  props: {
    crud: {
      type: Crud,
      required: true
    },
    title: {
      type: String
    }
  },
  setup(props: { crud: Crud }) {
    const dialog = props.crud.deleteDialog
    return {
      dialog: dialog,
      onYes() {
        this.dialog.ok()
        return;
      },
      onNo() {
        this.dialog.close()
        return;
      }
    }
  }
}
</script>


<style lang="scss">
</style>
