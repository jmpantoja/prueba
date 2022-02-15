<template>
  <el-button
    circle
    class="button-audio"
    :icon="icon"
    @click="onClick"/>
</template>

<script lang="ts">
import {Component, Emit, Prop, Vue} from 'nuxt-property-decorator'
import {mapGetters, mapMutations} from 'vuex'

@Component({
  inheritAttrs: false,
  name: 'ButtonAudio',
})
export default class extends Vue {
  @Prop({required: true, type: Boolean}) active!: Boolean

  @Emit('update:active')
  private onClick() {
    return !this.active
  }

  private get icon() {
    return this.active ? 'icon-volume-medium' : 'icon-volume-mute2'
  }

}
</script>

<style scoped lang="scss">
.button-audio {
  border: none;
  font-size: 1.2rem;
}
</style>
