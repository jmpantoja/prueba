<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">
    <template v-slot:fields="{model}">

      <ad-field-group title="Director">
        <ad-field-full-name v-model="model.name" prop="name" :label="admin.message('form.name')"/>
      </ad-field-group>

    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";

@Component({
  name: 'DirectorForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity

  public empty = {
    name: {
      name: null,
      lastName: null,
    }
  }


}
</script>

<style scoped lang="scss">

</style>
