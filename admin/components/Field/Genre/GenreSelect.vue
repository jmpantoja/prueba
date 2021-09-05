<template>
  <el-form-item :label="label">

    <el-select
      v-model="data"
      :prop="prop"
      multiple
      placeholder="Select"
      value-key="id"
      style="width: 100%"

    >
      <el-option
        v-for="item in options"
        :key="item.id"
        :label="item.name"
        :value="item"
      >
      </el-option>
    </el-select>

  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

@Component({
  name: 'Select'
})
export default class extends mixins(Field) {

  public options: Array<{}> = [];

  public mounted() {
    this.loadAll()
  }

  public defaults(data: any): any {
    return data
  }

  public async loadAll() {
    await this.$adminManager.byName('genres')
      .get({page_size: 1000})
      .then((response) => {
        this.options = response['items']
      })
  }
}

</script>

