<template>
  <ad-toolbar :entity="entity">

    <template slot="list">
      <ad-toolbar-download :formats="['xlsx', 'csv', 'yaml']"/>
      <ad-toolbar-create/>
    </template>

    <template slot="delete">
      <ad-toolbar-back/>
    </template>

    <template slot="edit">
      <ad-toolbar-back/>
    </template>

    <template slot="create">
      <ad-toolbar-back/>
    </template>


  </ad-toolbar>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";

@Component({
  name: 'DirectorToolbar'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: false, type: Object}) entity!: object;

}
</script>

<style scoped lang="scss">

::v-deep .el-button {
  font-size: 2.5rem;
  margin-left: 1rem;
}
</style>
