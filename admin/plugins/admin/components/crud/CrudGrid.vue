<template>
  <div>
    <v-data-table
      fixed-header
      height="calc(100vh - 340px)"
      hide-default-footer
      :headers="grid.headers"
      :items="grid.items"
      :loading="grid.loading"
      :options.sync="grid.options"
      :server-items-length="grid.total"
      :page.sync="grid.page"
      @page-count="pageCount = $event"
    >
      <template
        v-for="header in grid.headers "
        :slot="'header.' + header.value"
        v-key="header.value"
      >
        <slot :name="'header.' + header.value" :header="header">
          {{ header.text }}
        </slot>
      </template>

      <template
        v-for="header in grid.headers"
        :slot="'item.' + header.value"
        v-key="header.value"
        slot-scope="{item}">
        <slot :name="'item.' + header.value" :item="item" :header="header" :value="$_.get(item, header.value)">
          {{ $_.get(item, header.value) }}
        </slot>
      </template>

      <template
        :slot="'item.__actions'"
        slot-scope="{item}">
        <slot :name="'item.__actions' " :item="item">
          <template
            v-for="action in grid.actions">
            <v-btn icon @click="execute(action.action, item)">
              <v-icon small>{{ action.icon }}</v-icon>
            </v-btn>
          </template>
        </slot>
      </template>


    </v-data-table>

    <div class="pa-2 text-center">
      <v-pagination
        v-model="grid.page"
        class="ma-2"
        :length="pageCount"
        total-visible="6"
      />
    </div>
  </div>
</template>

<script lang="ts">
import {Crud} from '~/plugins/admin/types'

const _ = require('lodash')

export default {
  name: 'CrudGrid',
  props: {
    crud: {
      type: Crud,
      required: true
    },
    headers: {
      type: Array,
      required: true
    },
    actions: {
      type: Object,
      default() {
        return {}
      }
    }
  },
  setup(props: { crud: Crud, headers: object[], actions: object }) {
    var grid = props.crud.grid;
    grid.initialize(props.headers, props.actions)

    return {
      pageCount: null,
      grid: grid,
      execute(method: string, item: object) {
        _.invoke(grid, method, item)
      }
    }
  }
}

</script>

<style lang="scss">
.crud-grid {

  .v-data-table {
    margin-left: 56px;
  }

  .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }
}
</style>
