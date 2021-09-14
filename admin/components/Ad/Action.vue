<template>
  <div :class="classes" v-loading="waiting">

    <div :class="{loading: waiting}">
      <component :is="components.toolbar" :action="action" :entity="entity"/>
      <el-card :shadow="shadow">
        <slot
          :components="components"
          :action="action"
          :entity="entity"
          :admin="admin"
        />
      </el-card>

    </div>
  </div>
</template>

<script lang="ts">

import {Component, Prop, Provide, Vue} from 'nuxt-property-decorator'
import {RouteMeta} from "~/types/route";
import {Entity} from "~/types/api";

const _ = require("lodash")

@Component({
  name: 'Action',
})
export default class extends Vue {
  private entity: Entity = {id: null};

  @Prop({
    required: false,
    type: Boolean,
    default: () => false
  }) readonly plain!: boolean;

  @Prop({
    required: false,
    type: Boolean,
    default: () => false
  }) readonly item!: boolean;

  @Provide('admin')
  public get admin() {

    const meta = this.routeMeta;
    const admin = this.$adminManager.byName(meta.admin)
    const roles = admin.rolesByName(meta.action)

    this.$security.assert(roles)
    return Vue.observable(admin)
  }

  public async fetch() {
    if (this.item && this.$route.params.id) {
      const id = this.$route.params.id
      this.entity = await this.admin.findOne(id) || {}
    }
  }

  public get routeMeta(): RouteMeta {
    return (this.$route.meta as RouteMeta)
  }

  public get components() {
    return this.routeMeta.components
  }

  public get action(): string {
    return this.routeMeta.action
  }

  public get shadow(): string {
    return this.plain ? 'never' : 'always'
  }

  public get classes(): object {
    return {
      action: true,
      [`action-${this.action}`]: true,
      plain: this.plain
    }
  }

  public get waiting() {
    return this.item && this.admin.loading
  }

}
</script>

<style scoped lang="scss">
.loading {
  visibility: hidden;
}

.action.plain {
  .el-card {
    background-color: transparent;
    border-color: transparent;
  }
}


</style>
