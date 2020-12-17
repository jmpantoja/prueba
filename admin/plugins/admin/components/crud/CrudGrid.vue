<template>
  <v-card class="crud-grid elevation-3 ma-3 overflow-hidden">
    <crud-panel :grid="grid">
      <template v-slot:filters="{filters}">
        <slot name="filters" :filters="filters"/>
      </template>


    </crud-panel>

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
        slot-scope="{item}"
      >
        <slot :name="'item.' + header.value" :item="item" :header="header" :value="$_.get(item, header.value)">
          {{ $_.get(item, header.value) }}
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

  </v-card>
</template>

<script lang="ts">
import {Grid} from '~/plugins/admin/types'
import CrudPanel from "~/plugins/admin/components/crud/CrudPanel.vue";

export default {
  name: 'CrudGrid',
  components: {CrudPanel},
  props: {
    grid: {
      type: Grid,
      required: true,
    }
  },
  setup() {
    return {
      pageCount: null,
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
