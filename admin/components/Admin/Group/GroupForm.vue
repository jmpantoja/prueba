<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">
    <template v-slot:fields="{model}">

      <ad-field-group title="General">

        <el-form-item prop="name" :label="admin.message('form.name')" :rules="rules.name">
          <el-input type="text" v-model="model.name"/>
        </el-form-item>

        <field-country-select v-model="model.country" prop="country" :label="admin.message('form.country')"/>

      </ad-field-group>

      <ad-field-group title="Albums">


        <ad-field-list v-model="model.albums" prop="albums" v-slot="{item, index}">

          #{{index}} {{ item.name }} ({{item.releaseAt}})

<!--          <el-form-item prop="name" :label="admin.message('form.name')" :rules="rules.name">-->
<!--            <el-input v-model="item.name"/>-->
<!--          </el-form-item>-->


<!--          <el-input v-model="item.releaseAt"/>-->

        </ad-field-list>

      </ad-field-group>

    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";


@Component({
  name: 'GroupForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity

  public empty = {
    country: 'UK',
    albums: []
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
