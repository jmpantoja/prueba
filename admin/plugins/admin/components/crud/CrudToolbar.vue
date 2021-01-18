<template>
  <div>
    <v-toolbar  class="mx-2 toolbar crud-toolbar" flat>
      <v-toolbar-title v-if="title" class="text-h3 font-weight-thin">
        {{ title }}
      </v-toolbar-title>
      <v-spacer/>

      <template
        v-for="action in grid.toolbar">
        <v-menu v-if="action.items" offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              icon
              v-bind="attrs"
              v-on="on"
            >
              <v-icon large>{{ action.icon }}</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item
              v-for="(item, index) in action.items"
              :key="index"
              @click="execute(action.action, item)"
            >
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>

        <v-btn v-else color="primary" icon @click="execute(action.action)">
          <v-icon large>{{ action.icon }}</v-icon>
        </v-btn>
      </template>

    </v-toolbar>
  </div>
</template>
<script lang="ts">
import {Crud} from "~/plugins/admin/types";

const _ = require('lodash')

export default {
  name: 'CrudToolbar',
  props: {
    crud: {
      type: Crud,
      required: true
    },
    title: {
      type: String,
    },
  },
  setup(props: { crud: Crud }) {
    const grid = props.crud.grid
    return {
      grid,
      execute(method: string, item: object) {
        _.invoke(grid, method, item)
      }
    }
  }
}
</script>


<style lang="scss">
.theme--light.v-toolbar.v-sheet.crud-toolbar {
  background-color: transparent;
}
</style>
