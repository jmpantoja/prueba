<!--suppress ALL -->
<template>
  <ad-datatable :default-query="defaultQuery">

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="admin.message('filters.name')" prop="name" v-model="filters.name"/>
    </template>

    <template slot="columns">
      <el-table-column prop="name" :label="admin.message('columns.name')" sortable="custom" v-slot="{row}">
        <ad-goto :entity="row">
          {{ row.name.lastName }}, {{ row.name.name }}
        </ad-goto>
      </el-table-column>
    </template>
  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";
import {TableQuery} from "~/types/grid";


@Component({
  name: 'DirectorList'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin

  public defaultQuery: TableQuery = {
    order: {
      prop: 'name',
      order: 'ascending'
    }
  }

}
</script>


