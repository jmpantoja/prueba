<template>
  <nuxt-link :to="href">
    <slot>
      {{ value }}
    </slot>
  </nuxt-link>

</template>

<script lang="ts">
import {Component, mixins, Prop} from "nuxt-property-decorator";
import {Entity} from "~/types/api";
import AdminAware from '~/mixins/AdminAware'

@Component({
  name: "Goto"
})
export default class extends mixins(AdminAware) {
  @Prop({required: true, type: Object as () => Entity}) readonly entity!: Entity;
  @Prop({required: false, type: String}) readonly value!: string;

  public get href() {
    return this.admin.pathByKey('edit', this.entity)
  }
}
</script>

<style scoped>

</style>
