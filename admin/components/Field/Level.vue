<template>
  <el-form-item :label="label" :prop="prop">
    <el-form-item
      class="el-col-4"
      :label="admin.message('form.level')"
      :prop="prop + '.level'"
      :rules="rules.level">

      <el-select
        filterable
        ref="select"
        v-model="data.level">

        <el-option
          v-for="level in $_.range(1, 21)"
          :key="level"
          :value="level"
          :label="'K'+ $_.padStart(level, 2, '0')"
        />

      </el-select>

    </el-form-item>

    <el-form-item
      class="el-col-4"
      :label="admin.message('form.page')"
      :prop="prop + '.page'">

      <el-select
        filterable
        ref="select"
        v-model="data.page">
        <el-option
          v-for="level in $_.range(1, 101)"
          :key="level"
          :value="level"
          :label="level"
        />
      </el-select>

    </el-form-item>


  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, Inject, mixins} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";


@Component({
  name: 'Level'
})
export default class extends mixins(Field) {
  @Inject('admin') private admin!: Admin

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
