<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

  <ad-form :entity="entity" :empty="empty">

    <template v-slot:fields="{model}">

      <ad-field-group title="General">
        <field-term v-model="model.term" prop="term" :label="admin.message('form.term')"/>

        <field-audio-path v-model="model.audio" prop="audio" :label="admin.message('form.audio')"/>

        <field-entry-type-select v-model="model.type" prop="type" :label="admin.message('form.type')"/>

        <field-level v-model="model.level" prop="level" :label="admin.message('form.level')"/>

      </ad-field-group>

      <ad-field-group title="Significados">

        <field-meaning-list v-model="model.meanings" prop="meanings"/>

      </ad-field-group>
    </template>
  </ad-form>
</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {Entity} from "~/types/api";


@Component({
  name: 'EntryForm'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity

  public empty = {
    term: {
      term: '',
      lang: 'en'
    },
    audio: null,
    level: {
      level: null,
      page: null
    },
    meanings: []
  }

  public rules = {
    name: [
      {required: true, message: 'es requerido'},
      // {max: 10, message: 'name is too long'}
    ]
  }

}
</script>

<style scoped lang="scss">

</style>
