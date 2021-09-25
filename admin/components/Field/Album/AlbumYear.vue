<template>
  <el-form-item :label="label">
    <el-date-picker type="year" v-model="data" :prop="prop" value-format="yyyy"/>
  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

@Component({
  name: 'Year'
})
export default class extends mixins(Field) {

  defaults(data: any): any {
    if (typeof data === 'object') {
      return data
    }

    return new Date(data, 1)

  }
}

</script>

