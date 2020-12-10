<template>
  <v-layout class="align-center layout pl-6 pt-2 app--page-header">
    <v-icon>mdi-home</v-icon>
    <v-breadcrumbs divider="/" :items="$menu.breadcrumbs($route.path)"/>
  </v-layout>
</template>

<script lang="ts">

import {defineComponent} from '@nuxtjs/composition-api'

export default defineComponent({
  name: 'AdminPageHeader',
  setup() {
    return {}
  }
})

</script>
