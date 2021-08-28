<template>
  <nuxt-link :to="href">
    <slot>
      {{ value }}
    </slot>
  </nuxt-link>

</template>

<script lang="ts">
import {Component, Inject, Prop, Vue} from "nuxt-property-decorator";
import {Entity} from "~/types/api";
import {Admin, AdminManager} from "~/src/Admin";

@Component({
  name: "Goto"
})
export default class extends Vue {
  @Inject('admin') private adminObject!: Admin
  @Inject('adminManager') private adminManager!: AdminManager

  @Prop({required: true, type: Object as () => Entity}) readonly entity!: Entity;
  @Prop({required: false, type: String}) readonly admin!: string;
  @Prop({required: false, type: String}) readonly value!: string;

  public get href() {
    if (this.admin) {
      const admin = this.adminManager.byName(this.admin)
      return admin.pathByKey('edit', this.entity)
    }

    return this.adminObject.pathByKey('edit', this.entity)
  }
}
</script>

<style scoped>

</style>
