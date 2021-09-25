<template>
  <el-form-item :label="label" :prop="prop">

    <ad-field-select
      use="music_groups"
      v-model="data"
      :normalize="normalize"
      :remote-query="remote"
    />

  </el-form-item>
</template>

<script lang="ts">
import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'
import {TableQuery} from "~/types/grid";


@Component({
  name: 'Select'
})
export default class extends mixins(Field) {
  public normalize(item: { id: string, name: string }): string {
    return item.name
  }

  public remote(input: string): TableQuery {
    return {
      filters: {
        name: {
          mode: 'contains',
          value: input
        }
      }
    }
  }

  public defaults(data: any): any {
    return data || {}
  }

}
</script>


<style scoped lang="scss">
.el-select {
  width: 100%;
}
</style>
