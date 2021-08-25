<template>
  <ad-datatable >

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="$t('admin.genres.filters.genre')" prop="name" v-model="filters.name"/>
    </template>

    <template slot="columns">
      <el-table-column prop="id" :label="$t('admin.genres.columns.id')" sortable="custom" width="300"/>
      <el-table-column prop="name" :label="$t('admin.genres.columns.genre')" sortable="custom"/>
    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'GenreList'
})
export default class extends Vue {


}
</script>


