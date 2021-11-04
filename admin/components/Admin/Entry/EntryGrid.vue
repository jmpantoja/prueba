<!--suppress ALL -->
<template>
  <ad-datatable>

    <template v-slot:filters="{filters}">
      <!--      <ad-filter-text :label="admin.message('filters.term')" prop="term" v-model="filters.term"/>-->

    </template>

    <template slot="columns">
      <el-table-column prop="term" :label="admin.message('columns.term')" sortable="custom" v-slot="{row}">
        <ad-goto :entity="row" :value="row.term.term"/>
      </el-table-column>
    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'EntryGrid'
})
export default class extends Vue {
  @Inject('admin') admin!: Admin;

}
</script>


