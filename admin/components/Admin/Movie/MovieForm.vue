<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">
    <template v-slot:fields="{model}">

      <ad-field-group title="General">

        <el-form-item prop="title" :label="admin.message('form.title')" :rules="rules.title">
          <el-input type="text" v-model="model.title"/>
        </el-form-item>

        <field-movie-year v-model="model.year" prop="year" :label="admin.message('form.year')"/>

        <field-genre-select v-model="model.genres" prop="genres" :label="admin.message('form.genres')"/>

      </ad-field-group>

      <ad-field-group title="Cast">
        <field-director-select v-model="model.director" prop="director" :label="admin.message('form.director')"/>
      </ad-field-group>

    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";


@Component({
  name: 'MovieForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity

  public empty = {}

  public rules = {
    title: [
      {required: true, message: 'es requerido'},
      {max: 10, message: 'name is too long'}
    ],
    name: [
      {required: true, message: 'es requerido'},
      {max: 10, message: 'name is too long'}
    ]
  }

}
</script>

<style scoped lang="scss">

</style>
