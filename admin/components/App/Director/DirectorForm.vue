<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">
    <template v-slot:fields="{model}">

      <ad-form-group title="Director">
        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>
      </ad-form-group>

      <!--      <ad-form-group title="Director B">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director C">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director D">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director E">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director F">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director G">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director H">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director I">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director J">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Director K">-->
      <!--        <ad-form-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>-->
      <!--      </ad-form-group>-->

    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";

@Component({
  name: 'DirectorForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity

  public empty = {
    name: {
      name: null,
      lastName: null,
    }
  }


}
</script>

<style scoped lang="scss">

</style>
