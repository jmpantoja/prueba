<template>
  <v-app class="app">
    <ui-drawer/>
    <ui-toolbar/>
    <v-main class="main">
      <ui-page-header/>
      <transition name="fade">
        <nuxt/>
      </transition>
    </v-main>
  </v-app>

</template>

<script>

import {Drawer, FullScreen, Locale, Menu, Profile} from "../plugins/admin/src/ui";
import {reactive} from "@nuxtjs/composition-api";


export default {
  provide() {
    const options = require('~/config/admin')

    const drawer = reactive(new Drawer())
    const fullScreen = new FullScreen(window.document)
    const locale = new Locale(this)
    const profile = new Profile(this)
    const menu = new Menu(locale, options.menu)

    return {
      drawer,
      fullScreen,
      locale,
      profile,
      menu
    }
  },
  data() {
    return {}
  }
}
</script>

<style lang="scss">
.main {
  background-color: #fafafa;
}
</style>
