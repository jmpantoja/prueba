<template>
  <v-data-table
    fixed-header
    height="calc(100vh - 310px)"
    hide-default-footer
    :headers="grid.columns"
    :items="grid.items"
    :loading="grid.loading"
    :options.sync="grid.options"
    :server-items-length="grid.total"
    :page.sync="grid.page"
    @page-count="grid.pageCount = $event"
  >

    <template
      v-for="(column, name) in grid.columns"
      :slot="'header.'+column.value">
      <span v-if="column.text" :key="name">
        {{ t(`grid.header.${column.text}`) }}
      </span>
    </template>

    <template
      v-for="(column, index) in grid.columns"
      :slot="'item.'+column.value"
      slot-scope="{item}">
      <component :key="index"
                 :is="column.type"
                 :name="column.value"
                 :item="item"
                 :value="$_.get(item, column.value)"/>
    </template>

    <template slot="item.__actions" slot-scope="{item}">
      <atn-button
        v-for="(button, name) in grid.buttons"
        :key="name"
        :params="{item}"
        :button="button"/>

    </template>
  </v-data-table>

</template>

<script>
import {Grid} from "../../src";
import AtnButton from "./AtnButton";

export default {
  name: "AtnAdminGrid",
  components: {AtnButton},
  props: {
    grid: {
      type: Grid,
      required: true
    }
  },
  computed:{
    namespace(){
      return this.grid.namespace
    }
  },
  mounted() {
    this.grid.reload()
  }
}
</script>

<style scoped>

</style>
