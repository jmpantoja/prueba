<!--suppress ALL -->
<template>
  <ad-datatable>

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="admin.message('filters.name')" prop="name" v-model="filters.name"/>
    </template>

    <template slot="columns">
      <el-table-column prop="id" :label="admin.message('columns.id')" sortable="custom" width="300"/>

      <el-table-column prop="name" :label="admin.message('columns.name')" sortable="custom" v-slot="{row}">
        {{ row.name.name }} {{ row.name.lastName }}
      </el-table-column>
    </template>
  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'DirectorList'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
}
</script>


