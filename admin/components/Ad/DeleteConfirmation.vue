<template>
  <div class="delete-confirmation">
    <p v-html="admin.message('message.delete_confirmation', {entity})"></p>
    <el-button @click="back">
      {{ $t('buttons.back') }}
    </el-button>
    <el-button @click="ok" type="danger" v-html="$t('buttons.yes_delete')"/>
  </div>
</template>

<script lang="ts">
import {Component, mixins, Prop} from "nuxt-property-decorator";
import {Entity} from "~/types/api";
import AdminAware from "~/mixins/AdminAware";

@Component({
  name: "DeleteConfirmation"
})
export default class extends mixins(AdminAware) {
  @Prop({required: false, type: Object as () => Entity}) readonly entity!: Entity;

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
