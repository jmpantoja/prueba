<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">
    <template v-slot:fields="{model}">

      <ad-form-group title="Director">
        <ad-form-full-name v-model="model.name" prop="name" :label="$t('admin.directors.form.name')"/>
      </ad-form-group>

      <ad-form-group title="pepe">
        <ad-form-full-name v-model="model.borrame" prop="borrame" :label="$t('admin.directors.form.name')"/>
      </ad-form-group>


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
    },
    borrame: {
      name: null,
      lastName: null,
    },
  }


}
</script>

<style scoped lang="scss">

</style>
