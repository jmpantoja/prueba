<template>
  <div id="appRoot">
    <template>
      <v-app class="app">
        <ui-drawer/>
        <!--        <app-drawer class="app&#45;&#45;drawer"/>-->
        <!--        <app-toolbar class="app&#45;&#45;toolbar"/>-->
        <v-main class="main">

          <!--          <page-header/>-->
          <div class="page-wrapper">
            <transition name="fade">
              <nuxt/>
            </transition>
          </div>
          <!--          <app-toast />-->
        </v-main>
      </v-app>
    </template>
  </div>
</template>

<script>
import UiDrawer from "~/modules/admin/components/ui/UiDrawer";

export default {
  name: "dashboard",
  components: {UiDrawer}
}
</script>

<style scoped>

</style>
