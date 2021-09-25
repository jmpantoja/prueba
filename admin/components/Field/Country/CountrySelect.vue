<template>
  <el-form-item :label="label" :prop="prop">
    <div class="ad-select-wrapper">
      <el-select
        :clearable="clearable"
        :placeholder="placeholder"

        ref="select"
        v-model="data"
        :prop="prop">

        <el-option key="UK" value="UK"/>
        <el-option key="USA" value="USA"/>
        <el-option key="SPAIN" value="Spain"/>
      </el-select>

    </div>
  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins, Prop} from 'nuxt-property-decorator'
const _ = require("lodash")

@Component({
  name: 'CountrySelect'
})
export default class extends mixins(Field) {
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
