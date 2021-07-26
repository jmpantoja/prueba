<template>
  <fieldset>
    <legend>{{ title }}</legend>

    <slot/>
  </fieldset>
</template>

<script lang="ts">
import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'FormGroup',
})
export default class extends Vue {
  @Prop({required: true, type: String}) title!: string;
  @Inject('admin') private admin!: Admin
  @Inject('adForm') private adForm!: object


  private mounted() {

    const rect = this.$el.getBoundingClientRect();
    const position = rect.top - rect.height - (15 * 5)

    this.adForm.addGroup({
      name: `group-${this._uid}`,
      title: this.title,
      position
    })
  }
}
</script>

<style scoped lang="scss">

</style>
