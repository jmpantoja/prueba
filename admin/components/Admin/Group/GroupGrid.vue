<!--suppress ALL -->
<template>
  <ad-datatable>

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="admin.message('filters.name')" prop="name" v-model="filters.name"/>
      <filter-country :label="admin.message('filters.country')" prop="country" v-model="filters.country"/>
    </template>

    <template slot="columns">
      <el-table-column prop="name" :label="admin.message('columns.name')" sortable="custom" v-slot="{row}">
        <ad-goto :entity="row" :value="row.name"/>
      </el-table-column>

      <el-table-column prop="country" :label="admin.message('columns.country')" sortable="custom" v-slot="{row}">
        {{row.country}}
      </el-table-column>

    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'GroupGrid'
})
export default class extends Vue {
  @Inject('admin') admin!: Admin;

}
</script>


