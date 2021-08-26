<template>
  <div class="action action-form" v-loading="waiting">
    <component :is="components.toolbar" :entity="entity"/>

    <el-card>

      <div class="delete-confirmation">
        <p v-html="admin.message('message.delete_confirmation', {entity})"></p>
        <el-button @click="back">
          {{ $t('buttons.back') }}
        </el-button>
        <el-button @click="ok" type="danger" v-html="$t('buttons.yes_delete')"/>
      </div>
    </el-card>
  </div>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import EntityAction from "~/mixins/EntityAction";
import {Entity} from "~/types/api";

@Component({
  name: 'Form',
})
export default class extends mixins(EntityAction) {
  in_progress: boolean = false

  back() {
    this.admin.goToList()
  }

  ok() {
    this.admin.delete((this.entity as Entity))
      .finally(() => {
        this.back()
      })

  }
}

</script>

<style scoped lang="scss">
.delete-confirmation {
  margin: 2em;
}
</style>
