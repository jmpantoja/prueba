<template>
  <v-app class="app">
    <atn-panel-drawer :panel="panel"/>
    <atn-panel-toolbar :panel="panel"/>

    <v-main class="main">
      <atn-panel-page-header :panel="panel"/>
      <transition name="fade">
        <nuxt/>
      </transition>
    </v-main>
  </v-app>
</template>

<script lang="ts">

import AtnPanelDrawer from "./AtnPanelDrawer.vue";
import AtnPanelToolbar from "./AtnPanelToolbar.vue";
import {Panel} from "~/plugins/atn/src";
import {menu} from '~/config/admin'

export default {
  name: "AdminPanel",
  components: {AtnPanelToolbar, AtnPanelDrawer},
  provide() {
    return {
      panel: this.panel
    }
  },
  data() {
    const panel = new Panel({
      menu,
      locale: this.$locale,
      auth: this.$auth,
      security: this.$security
    })

    return {
      panel
    }
  }
}
</script>

<style lang="scss">
.main {
  background-color: #fafafa;
}
</style>
