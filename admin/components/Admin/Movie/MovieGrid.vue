<!--suppress ALL -->
<template>
  <ad-datatable>

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="admin.message('filters.title')" prop="title" v-model="filters.title"/>
    </template>

    <template slot="columns">
      <el-table-column prop="title" :label="admin.message('columns.title')" sortable="custom" v-slot="{row}">
        <ad-goto :entity="row" :value="row.title"/>
      </el-table-column>

    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'MovieGrid'
})
export default class extends Vue {
  @Inject('admin') admin!: Admin;

}
</script>


