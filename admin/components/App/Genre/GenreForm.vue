<template>
  <ad-form :entity="entity">
    <template v-slot:fields="{model}">
      <ad-form-group title="Género">
        <el-form-item prop="name" :label="$t('admin.genres.form.name')" :rules="rules.name">
          <el-input v-model="model.name" autocomplete="off"/>
        </el-form-item>
      </ad-form-group>

      <!--      <ad-form-group title="Contácto">-->
      <!--        <el-form-item prop="name" label="Genre 1">-->
      <!--          <el-input v-model="model.name" autocomplete="off"/>-->
      <!--        </el-form-item>-->

      <!--        <ad-form-full-name v-model="model.fullName" prop="fullName" label="Full Name"/>-->

      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Métodos de Pago">-->
      <!--        <el-form-item prop="name" label="Genre 1">-->
      <!--          <el-input v-model="model.name" autocomplete="off"/>-->
      <!--        </el-form-item>-->

      <!--        <ad-form-full-name v-model="model.fullName" prop="fullName" label="Full Name"/>-->

      <!--      </ad-form-group>-->

      <!--      <ad-form-group title="Personal">-->
      <!--        <el-form-item prop="name" label="Genre 1">-->
      <!--          <el-input v-model="model.name" autocomplete="off"/>-->
      <!--        </el-form-item>-->

      <!--        <ad-form-full-name v-model="model.fullName" prop="fullName" label="Full Name"/>-->

      <!--      </ad-form-group>-->


      <!--      <ad-form-header title="BBBB"/>-->
      <!--      <el-form-item prop="name" label="Genre 2">-->
      <!--        <el-input v-model="model.name2" autocomplete="off"/>-->
      <!--      </el-form-item>-->

      <!--      <ad-form-header title="CCCC"/>-->
      <!--      <el-form-item prop="name" label="Genre 3">-->
      <!--        <el-input v-model="model.name3" autocomplete="off"/>-->
      <!--      </el-form-item>-->

      <!--      <ad-form-header title="DDDD"/>-->
      <!--      <el-form-item prop="name" label="Genre 4">-->
      <!--        <el-input v-model="model.name4" autocomplete="off"/>-->
      <!--      </el-form-item>-->


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
