<template>
  <div class="admin">
    <component :is="components.toolbar" :context="context"/>
    <el-card>
      <component :is="components.list" :context="context"/>
    </el-card>
  </div>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import Action from '~/mixins/Action'

@Component({
  name: 'List',
})
export default class extends mixins(Action) {


}
</script>

<style scoped lang="scss">
::v-deep {

  .el-card {
    margin-top: $main-padding;
    padding: 0;
    height: $panel-height;

    .el-card__body {
      padding: 0;
    }
  }
}


</style>
