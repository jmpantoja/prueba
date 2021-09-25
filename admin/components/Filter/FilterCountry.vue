<template>
  <el-form-item class="filter" :label="label">
    <field-country-select :prop="prop + '.value'" v-model="data.value" :placeholder="$t('fields.placeholder')"/>
  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

const _ = require("lodash")

@Component({
  name: 'FilterCountry'
})
export default class extends mixins(Field) {
  public modes = ['equals', 'contains', 'begins', 'ends']

  public defaults(data: Object): Object {
    const value = _.merge({
      mode: 'equals',
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
