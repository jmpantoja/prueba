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
import {Locale, Panel} from "~/plugins/atn/src";
import {menu} from '~/config/admin'

export default {
  name: "AdminPanel",
  components: {AtnPanelToolbar, AtnPanelDrawer},
  data() {
    const locale = new Locale({
      $i18n: this.$i18n,
      localePath: this.localePath,
      $moment: this.$moment
    });

    return {
      panel: new Panel({
        menu,
        auth: this.$auth,
        locale: locale
      })
    }
  }
}
</script>

<style lang="scss">
.main {
  background-color: #fafafa;
}
</style>
