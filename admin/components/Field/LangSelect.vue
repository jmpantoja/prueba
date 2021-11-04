<template>
  <el-form-item :label="label" :prop="prop">
<!--    <div class="ad-select-wrapper">-->
      <el-select
        :clearable="clearable"
        :placeholder="placeholder"

        ref="select"
        v-model="data"
        :prop="prop">

        <el-option key="SPANISH" value="es" :label="admin.message('form.option_spanish')"/>
        <el-option key="ENGLISH" value="en" :label="admin.message('form.option_english')"/>
      </el-select>

<!--    </div>-->
  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, Inject, mixins, Prop} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";

const _ = require("lodash")

@Component({
  name: 'LangSelect'
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
