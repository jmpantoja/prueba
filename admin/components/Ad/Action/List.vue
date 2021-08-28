<template>
  <div class="action action-list">
    <component :is="components.toolbar"/>
    <el-card>
      <component :is="components.grid"/>
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

</style>
