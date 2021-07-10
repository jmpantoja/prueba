<template>
  <ad-datatable :endpoint="endpoint">

    <template v-slot:filters="{filters}">
      <ad-filter-text label="name" prop="name" v-model="filters.name"/>
    </template>

    <template v-slot:columns>
      <el-table-column prop="id" label="id" sortable="custom"/>
      <el-table-column prop="name" label="género" sortable="custom"/>
    </template>

  </ad-datatable>

</template>

<script lang="ts">

import {Component, Prop, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'GenreList'
})
export default class extends Vue {
  @Prop({required: true, type: String}) endpoint!: string
}
</script>

<style scoped lang="scss">


</style>
