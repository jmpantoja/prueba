<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">
    <template v-slot:fields="{model}">

      <ad-field-group title="General">

        <el-form-item prop="name" :label="admin.message('form.name')" :rules="rules.name">
          <el-input type="text" v-model="model.name"/>
        </el-form-item>

        <field-group-select v-model="model.group" prop="group" :label="admin.message('form.group')"/>

      </ad-field-group>

    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";


@Component({
  name: 'AlbumForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity

  public empty = {
    songs: []
  }

  public rules = {
    name: [
      {required: true, message: 'es requerido'},
      // {max: 10, message: 'name is too long'}
    ]
  }

}
</script>

<style scoped lang="scss">

</style>
