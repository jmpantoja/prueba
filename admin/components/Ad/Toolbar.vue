<template>
  <div class="admin-toolbar">

    <div class="admin-toolbar__title">
      <slot name="title">
        {{ $t(title) }}
      </slot>
    </div>

    <div class="admin-toolbar__actions">
      <slot>

      </slot>
    </div>
  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'Toolbar',

})
export default class extends Vue {
  @Prop({required: false, type: String}) title!: string
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
