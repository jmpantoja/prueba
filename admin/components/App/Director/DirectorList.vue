<!--suppress ALL -->
<template>
  <ad-datatable>

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="$t('admin.directors.filters.name')" prop="name" v-model="filters.name"/>
    </template>

    <template slot="columns">
      <el-table-column prop="id" :label="$t('admin.directors.columns.id')" sortable="custom" width="300"/>

      <el-table-column prop="name" :label="$t('admin.directors.columns.name')" sortable="custom" v-slot="{row}">
        {{ row.name.name }} {{ row.name.lastName }}
      </el-table-column>

    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Vue} from 'nuxt-property-decorator'


@Component({
  name: 'DirectorList'
})
export default class extends Vue {


}
</script>


