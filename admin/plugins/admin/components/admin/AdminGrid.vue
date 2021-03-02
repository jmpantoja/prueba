<template>
  <v-data-table
    fixed-header
    height="calc(100vh - 310px)"
    hide-default-footer
    :headers="grid.headers"
    :items="grid.items"
    :loading="grid.loading"
    :options.sync="grid.options"
    :server-items-length="grid.total"
    :page.sync="grid.page"
    @page-count="grid.pageCount = $event"
  >
    <template slot="item.__actions" slot-scope="{item}">
      <v-btn v-for="(action, name) in grid.actions"
             :key="name"
             icon
             @click="onAction(name, item)">
        <v-icon small>{{ action.icon }}</v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import {eventBus, Grid} from "~/plugins/admin/src/admin";

export default {
  name: "AdminGrid",
  props: {
    grid: {
      type: Grid,
      required: true
    }
  },
  methods: {
    onAction(event, record) {
      eventBus.$emit(event, record)
    }
  },
  created() {
    eventBus.$on('onChangeDataSet', ()=>{
      this.grid.reload()
    })
  }
}
</script>

<style scoped>

</style>
