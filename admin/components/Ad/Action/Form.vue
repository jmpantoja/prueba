<template>
  <div class="action action-form" v-loading="waiting">
    <component :is="components.toolbar" :entity="entity"/>
    <el-card>
      <component :is="components.form" :entity="entity"/>
    </el-card>
  </div>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import EntityAction from "~/mixins/EntityAction";

function delay(ms: number) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

@Component({
  name: 'Form',
})
export default class extends mixins(EntityAction) {

}

</script>

<style scoped lang="scss">

</style>
