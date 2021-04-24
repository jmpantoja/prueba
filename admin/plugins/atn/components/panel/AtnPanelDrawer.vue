<template>
  <v-navigation-drawer
    v-model="panel.drawer"
    fixed
    app
    width="260"
  >
    <v-toolbar color="primary" dark>
      <img src="/admin/static/logo.svg" height="36" width="36" alt="Vue Material Admin Template">
      <v-toolbar-title class="ms-0 ps-3 font-weight-medium">
        <span>{{ $t('app.title') }}</span>
      </v-toolbar-title>
    </v-toolbar>
    <vue-perfect-scrollbar class="drawer-menu--scroll" :settings="scrollSettings">
      <v-list
        nav
        dense
      >
        <template
          v-for="(group, key) in panel.menu">
          <v-list-group
            :key="key"
            v-if="isGranted(group) && group.items"
            :prepend-icon="group.icon">

            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>{{ $t(group.text) }}</v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item
              v-for="(item, key) in group.items"
              v-if="isGranted(item)"
              :key="key"
              :to="localePath(item.href) || '#'"
              link
            >
              <v-list-item-icon>
                <v-icon v-if="item.icon">{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ $t(item.text) }}</v-list-item-title>
            </v-list-item>
          </v-list-group>

          <v-list-item
            v-else-if="isGranted(group)"
            :key="key"
            :to="localePath(group.href) || '#'"
          >
            <v-list-item-icon>
              <v-icon v-if="group.icon">{{ group.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{ $t(group.text) }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </vue-perfect-scrollbar>
  </v-navigation-drawer>
</template>
<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import {Panel} from "~/plugins/atn/src";

export default {
  name: 'AtnPanelDrawer',
  props: {
    panel: {
      type: Panel,
      required: true
    }
  },
  components: {
    VuePerfectScrollbar
  },
  data() {
    return {
      scrollSettings: {
        maxScrollbarLength: 160
      }
    }
  },
  methods: {
    isGranted(group) {
      if(!group.roles){
        return true
      }

      return this.panel.isGranted(group.roles)
    }
  }
}

</script>

<style lang="scss">
#appDrawer {
  overflow: hidden;

  .v-toolbar {
    z-index: 2;
  }

  .drawer-menu--scroll {
    height: calc(100vh - 64px);
    overflow: auto;
  }
}
</style>
