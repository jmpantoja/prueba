<template>
  <v-toolbar class="mx-2 toolbar crud-toolbar" flat>
    <v-toolbar-title class="text-h3 font-weight-thin">
      {{ $t(toolbar.title) }}
    </v-toolbar-title>
    <v-spacer/>

    <v-btn color="primary" icon>
      <v-icon large>mdi-download</v-icon>
    </v-btn>
  </v-toolbar>
</template>

<script>
import {Toolbar} from "../../src/admin";

export default {
  name: 'AdminToolbar',
  props: {
    toolbar: {
      type: Toolbar,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.v-toolbar.v-sheet.crud-toolbar {
  background-color: transparent;

  ::v-deep .v-toolbar__title {
    line-height: 3.75rem;
  }
}
</style>
