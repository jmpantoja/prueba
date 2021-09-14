<template>
  <el-form-item class="filter filter-text" :label="label">

    <el-form-item class="filter-text__mode" :prop="prop + '.mode'">
      <el-select v-model="data.mode" placeholder="Mode">
        <el-option
          v-for="item in modes"
          :key="item"
          :label="$t('filters.'+item)"
          :value="item">
        </el-option>
      </el-select>
    </el-form-item>

    <el-form-item class="filter-text__value" :prop="prop + '.value'">
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
  public modes = ['equals', 'contains', 'begins', 'ends']

  public defaults(data: Object): Object {
    const value = _.merge({
      mode: 'contains',
      value: null
    }, data)

    this.$emit('input', value)
    return value
  }
}

</script>

<style scoped lang="scss">

.filter-text {

  .filter-text__mode {
    max-width: 10rem;
  }

  .filter-text__value {

    flex-grow: 1;
  }
}
</style>
