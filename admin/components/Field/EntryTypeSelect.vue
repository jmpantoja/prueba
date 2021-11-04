<template>
  <el-form-item :label="label" :prop="prop">

    <el-form-item
      class="el-col-24">
      <el-radio-group v-model="data" size="medium">

        <el-radio-button label="word">{{ admin.message('form.option_word') }}</el-radio-button>
        <el-radio-button label="phrasal_verb">{{ admin.message('form.option_phrasal_verb') }}</el-radio-button>
        <el-radio-button label="collocation">{{ admin.message('form.option_collocation') }}</el-radio-button>

      </el-radio-group>

      <!--      <el-select-->
      <!--        :clearable="clearable"-->
      <!--        :placeholder="placeholder"-->
      <!--        ref="select"-->
      <!--        v-model="data"-->
      <!--        :prop="prop">-->

      <!--        <el-option key="WORD" value="word" :label="admin.message('form.option_word')"/>-->
      <!--        <el-option key="PHRASAL_VERB" value="phrasal_verb" :label="admin.message('form.option_phrasal_verb')"/>-->
      <!--        <el-option key="COLLOCATION" value="collocation" :label="admin.message('form.option_collocation')"/>-->
      <!--      </el-select>-->

    </el-form-item>

  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, Inject, mixins, Prop} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";

const _ = require("lodash")

@Component({
  name: 'EntryTypeSelect'
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

</style>
