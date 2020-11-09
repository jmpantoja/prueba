<template>
  <v-layout class="align-center layout px-4 pt-4 app--page-header">
    <v-icon>mdi-home</v-icon>

    <v-breadcrumbs divider="/" :items="breadcrumbs"/>
    <v-spacer/>
    <div class="page-header-right">
      <v-btn icon>
        <v-icon class="text--secondary">
          mdi-refresh
        </v-icon>
      </v-btn>
    </div>
  </v-layout>
</template>

<script>
import menu from '~/admin/menu'

var url = require('url');

export default {
  computed: {
    breadcrumbs() {
      const breadcrumbs = []
      menu.call(this).forEach((item) => {
        if (item.items) {
          const child = item.items.find((i) => {
            const path = url.parse(i.href).pathname;
            return path === this.$route.path
          })
          if (child) {
            const action = this.$route.params.action
            breadcrumbs.push({text: item.title})

            if (action) {
              breadcrumbs.push({text: this.$t('app.' + action), disabled: true})
            }
            breadcrumbs.push({text: child.title, disabled: true})
          }
        } else if (item.href === this.$route.path) {
          breadcrumbs.push({text: item.title})
        }
      })
      return breadcrumbs
    }
  }
}
</script>
