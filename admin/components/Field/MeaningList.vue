<template>
  <ad-field-list v-model="data" v-slot="{index, item }" @add="add">
    <field-term
      term_label="form.meaning"
      v-model="item.term"
      :prop="prop + '['+index+'].term'"/>


  </ad-field-list>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

const _ = require("lodash")

@Component({
  name: 'MeaningList'
})
export default class extends mixins(Field) {
  public add(index: number) {
    this.data.push({
      term: {
        term: null,
        lang: 'es'
      },
      deep: index + 1
    })
  }

}
</script>


<style scoped lang="scss">

</style>
