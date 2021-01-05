<template>
  <div>
    <slot name="form"/>
    <slot name="dialog">
      <crud-dialog :crud="crud"/>
    </slot>
    <v-card class="crud-grid elevation-3 ma-3 overflow-hidden">
      <slot name="panel"/>
      <slot name="grid"/>
    </v-card>
  </div>
</template>

<script lang="ts">

import {Crud} from "~/plugins/admin/types";
import CrudDialog from "~/plugins/admin/components/crud/CrudDialog.vue";

const _ = require('lodash')

export default {
  name: 'Crud',
  components: {CrudDialog},
  props: {
    crud: {
      type: Crud,
      required: true
    }
  },
}

</script>

<style lang="scss">
.crud-grid {

  .v-data-table {
    margin-left: 56px;
  }

  .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }
}
</style>
