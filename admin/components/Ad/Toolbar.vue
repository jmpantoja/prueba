<template>
  <div class="admin-toolbar">
    <div class="admin-toolbar__title" v-if="title">
      <slot name="title">
        {{ title }}
      </slot>
    </div>

    <div class="admin-toolbar__actions">
      <slot v-for="(_, path) in admin.paths"
            v-if="path === action"
            :name="path"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Component, mixins, Prop} from 'nuxt-property-decorator'
import {Entity} from "~/types/api";
import AdminAware from "~/mixins/AdminAware";

const _ = require("lodash")

@Component({
  name: 'Toolbar'
})
export default class extends mixins(AdminAware) {

  @Prop({
    required: true,
    type: String
  }) readonly action!: string;

  @Prop({
    required: false,
    type: Object as () => Entity
  }) readonly entity!: Entity;


  public get title() {
    const key = `toolbar.${this.action}`;
    const params = {entity: this.entity};

    return this.admin.message(key, params)
  }
}
</script>

<style lang="scss">


.admin-toolbar {

  height: $toolbar-height;

  display: flex;
  justify-content: space-between;

  color: $--color-primary;

  .admin-toolbar__title,
  .admin-toolbar__actions,
  {
    line-height: 3.5rem;
    align-self: center;

  }

  .admin-toolbar__title {
    font-size: 3.5rem;
    font-weight: lighter;
  }

  .admin-toolbar__action {
    display: inline-block;
    margin-left: 1rem;
  }

  .admin-toolbar__action > .el-button,
  .admin-toolbar__action > .el-dropdown > .el-button {
    font-size: 2.5rem;
  }

}


</style>

