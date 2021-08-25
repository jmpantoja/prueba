<template>
  <div class="admin-toolbar">
    <div class="admin-toolbar__title" v-if="title">
      <slot name="title">
        {{ title }}
      </slot>
    </div>

    <div class="admin-toolbar__actions">
      <slot v-for="(_, action) in admin.paths"
            v-if="action === admin.view"
            :name="action"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Component, Inject, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";

const _ = require("lodash")

@Component({
  name: 'Toolbar'
})
export default class extends Vue {

  @Inject('admin') private admin!: Admin
  @Prop({required: false, type: Object as () => Entity}) readonly entity!: Entity;
  private title: string | null = null;

  created() {
    this.updateEntity(this.entity);
  }

  @Watch('entity')
  updateEntity(entity?: Entity) {

    const key = `toolbar.${this.admin.view}`;
    const params = {entity: entity};

    this.title = this.admin.message(key, params)
  }

}
</script>

<style scoped lang="scss">
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
}

</style>
