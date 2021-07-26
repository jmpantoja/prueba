<template>
  <ad-datatable >

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="$t('admin.genre.filters.genre')" prop="name" v-model="filters.name"/>
    </template>

    <template v-slot:columns="{goToEdit, goToDelete}">
      <el-table-column prop="id" :label="$t('admin.genre.columns.id')" sortable="custom" width="300"/>
      <el-table-column prop="name" :label="$t('admin.genre.columns.genre')" sortable="custom"/>

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


