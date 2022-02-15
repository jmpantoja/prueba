<template>
  <ad-toolbar :action="action" :entity="entity">

    <template slot="list">
      <!--      <ad-toolbar-download />-->
      <ad-toolbar-download :files="['xlsx', 'csv', 'yaml']"/>
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

import {Component, mixins, Prop} from 'nuxt-property-decorator'
import AdminAware from "~/mixins/AdminAware";
import {Entity} from "~/types/api";

@Component({
  name: 'EntryToolbar'
})
export default class extends mixins(AdminAware) {
  @Prop({
    required: true,
    type: String
  }) readonly action!: string;

  @Prop({
    required: false,
    type: Object as () => Entity
  }) readonly entity!: Entity;

}
</script>
