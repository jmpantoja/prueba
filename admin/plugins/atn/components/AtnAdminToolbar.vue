<template>
  <v-toolbar class="mx-2 toolbar crud-toolbar" flat>
    <v-toolbar-title class="text-h3 font-weight-thin">
      {{ trans('title') }}
    </v-toolbar-title>
    <v-spacer/>

    <atn-button
      v-for="(button, name) in toolbar.buttons"
      :ref="'button-'+name"
      :key="name"
      :button="button"/>
  </v-toolbar>
</template>

<script>
import {Toolbar} from "../src";

export default {
  name: "AtnAdminToolbar",
  props: {
    toolbar: {
      type: Toolbar
    }
  },
  inject: ['trans']
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
