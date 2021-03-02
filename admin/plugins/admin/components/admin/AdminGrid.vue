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
      <admin-action
        v-for="(action, index) in grid.actions"
        :key="index"
        :action="action"
        :params="{record: item}"/>

    </template>
  </v-data-table>
</template>

<script>
import {Grid} from "~/plugins/admin/src/admin";
import AdminAction from "./AdminAction";

export default {
  name: "AdminGrid",
  components: {AdminAction},
  props: {
    grid: {
      type: Grid,
      required: true
    }
  },
  methods: {
    onAction(action, record) {
      action.emit()

      this.grid.emit(action.name, {record})
    }
  }
}
</script>

<style scoped>

</style>
