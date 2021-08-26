<template>
  <ad-form :entity="entity">
    <template v-slot:fields="{model}">
      <ad-form-group title="Género">
        <el-form-item prop="name" :label="admin.message('form.name')" :rules="rules.name">
          <el-input v-model="model.name" autocomplete="off"/>
        </el-form-item>
      </ad-form-group>
    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";

@Component({
  name: 'GenreForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: object


  public rules = {
    name: [
      {required: true, message: 'es requerido'},
      {max: 10, message: 'name is too long'}
    ]
  }
}
</script>

<style scoped lang="scss">

</style>
