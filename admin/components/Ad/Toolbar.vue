<template>
  <div class="admin-toolbar">
    <div class="admin-toolbar__title">
      <slot name="title">
        {{ $t(title, {entity: model}) }}
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

@Component({
  name: 'Toolbar',
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin

  @Prop({required: false, type: String}) title!: string
  @Prop({required: false, type: Object}) entity!: object;

  public model: object | null = null;

  @Watch('entity')
  private updateEntity(entity) {

    if (!!this.model) {
      return
    }
    this.model = {...entity}
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
