<template>
  <el-form-item :label="label" :prop="prop">
    <el-form-item
      :label="admin.message(term_label)"
      class="el-col-19"
      :prop="prop + '.term'"
      :rules="rules.term">

      <el-input v-model="data.term"/>
    </el-form-item>

    <el-form-item
      :label="admin.message('form.lang')"
      class="el-col-5"
      :prop="prop + '.lang'">
      <field-lang-select v-model="data.lang"/>
    </el-form-item>


  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, Inject, mixins, Prop} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";

@Component({
  name: 'Term'
})
export default class extends mixins(Field) {
  @Inject('admin') private admin!: Admin
  @Prop({
    required: false,
    type: String,
    default: () => 'form.term'
  }) readonly term_label!: string;

  defaults(data: any): any {
    return data || {}
  }

  public rules: Object = {
    term: [
      {required: true, message: 'es requerido'}
    ]
  }
}
</script>
