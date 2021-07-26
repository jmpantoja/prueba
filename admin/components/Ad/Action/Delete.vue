<template>
  <div class="action action-form">
    <component :is="components.toolbar" :entity="entity"/>

    <el-card>
      {{ admin.view }}
      {{ entity }}

    </el-card>
  </div>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import EntityAction from "~/mixins/EntityAction";

@Component({
  name: 'Form',
})
export default class extends mixins(EntityAction) {

}

</script>

<style scoped lang="scss">

</style>
