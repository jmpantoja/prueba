<template>
  <div class="flashcard-toolbar">
    <button-audio :active.sync="settings.audio"/>
  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Settings} from "~/types/app";


@Component({
  inheritAttrs: false,
  name: 'FlashcardToolbar',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Settings}) settings!: Settings

}
</script>

<style scoped lang="scss">

</style>
