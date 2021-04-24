<template>
  <v-layout class="align-center layout pl-6 pt-2 app--page-header">
    <v-icon>mdi-home</v-icon>
    <v-breadcrumbs divider="/" :items="panel.breadcrumbs($route.path)"/>
  </v-layout>
</template>

<script lang="ts">
import {Panel} from "~/plugins/atn/src";

export default {
  name: 'AtnPanelPageHeader',
  props: {
    panel: {
      type: Panel,
      required: true
    }
  },
}

</script>
