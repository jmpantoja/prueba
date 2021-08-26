<!--suppress ALL -->
<template>
  <ad-datatable>

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="admin.message('filters.title')" prop="title" v-model="filters.title"/>
    </template>

    <template slot="columns">
      <el-table-column prop="id" :label="admin.message('columns.id')" sortable="custom" width="300"/>
      <el-table-column prop="title" :label="admin.message('columns.title')" sortable="custom"/>

    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'MovieList'
})
export default class extends Vue {
  @Inject('admin') admin!: Admin;

}
</script>


