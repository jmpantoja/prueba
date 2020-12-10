<template>
</template>

<script lang="ts">

import {defineComponent} from "@nuxtjs/composition-api";

export default defineComponent({
  middleware({app, redirect}) {
    if (app.$auth.$storage.state.loggedIn) {
      const dashboard = app.localePath('dashboard')
      redirect(dashboard)
    }
  }
})
</script>
