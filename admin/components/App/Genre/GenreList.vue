<template>
  <ad-datatable :context="context">

    <template v-slot:filters="{filters}">
      <ad-filter-text :label="$t('admin.genre.filters.genre')" prop="name" v-model="filters.name"/>
    </template>

    <template v-slot:columns>
      <el-table-column prop="id" :label="$t('admin.genre.columns.id')" sortable="custom" width="300"/>
      <el-table-column prop="name" :label="$t('admin.genre.columns.genre')" sortable="custom"/>
    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, mixins, Prop, Vue} from 'nuxt-property-decorator'

import Context from "~/mixins/Context";
import {AdminContext} from "~/types";

@Component({
  name: 'GenreList'
})
export default class extends mixins(Context) {


}
</script>


