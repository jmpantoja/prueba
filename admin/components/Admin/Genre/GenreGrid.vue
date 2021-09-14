<template>
  <ad-datatable :default-query="defaultQuery">

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="admin.message('filters.genre')" prop="name" v-model="filters.name"/>
    </template>

    <template slot="columns">
      <el-table-column prop="name" :label="admin.message('columns.genre')" sortable="custom" v-slot="{row}">
        <ad-goto :entity="row" :value="row.name"/>
      </el-table-column>
    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import {TableQuery} from "~/types/grid";
import AdminAware from "~/mixins/AdminAware";


@Component({
  name: 'GenreGrid'
})
export default class extends mixins(AdminAware) {

  public defaultQuery: TableQuery = {
    order: {
      prop: 'name',
      order: 'ascending'
    }
  }
}
</script>


