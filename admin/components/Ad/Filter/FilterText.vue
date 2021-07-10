<template>
  <el-form-item :label="label" :prop="prop">
    <el-form-item>
      <el-select v-model="data.mode" placeholder="Mode">
        <el-option
          v-for="item in modes"
          :key="item"
          :label="item"
          :value="item">
        </el-option>
      </el-select>
    </el-form-item>

    <el-form-item>
      <el-input v-model="data.value" autocomplete="off"/>
    </el-form-item>

  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

const _ = require("lodash")

@Component({
  name: 'FilterText'
})
export default class extends mixins(Field) {

  public modes = ['contains', 'equals', 'begins', 'ends']

  public defaults(data: Object): Object {
    return _.merge(data, {
      mode: 'contains',
      value: null
    })
  }

}

</script>

