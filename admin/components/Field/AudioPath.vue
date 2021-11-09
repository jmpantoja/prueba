<template>
  <el-form-item :label="label" :prop="prop">
    <el-form-item
      class="el-col-12">

      <el-input v-model="data"/>
    </el-form-item>


  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, Inject, mixins, Prop} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";

const _ = require("lodash")

@Component({
  name: 'AudioPath'
})
export default class extends mixins(Field) {
  @Inject('admin') private admin!: Admin
  @Prop({required: false, type: String, default: () => null}) readonly placeholder!: string | null;

  clearable: boolean = !_.isEmpty(this.placeholder)

  public defaults(data: any): any {
    return data || null
  }

}
</script>


<style scoped lang="scss">
.el-select {
  width: 100%;
}
</style>
