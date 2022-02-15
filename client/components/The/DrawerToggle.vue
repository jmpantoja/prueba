<template>
  <el-button
    class="app-menu-toggle"
    circle
    icon="icon-menu"
    @click="toggle"/>

</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters, mapMutations} from 'vuex'

@Component({
  name: 'TheDrawerToggle',
  inheritAttrs: false,

  methods: mapMutations({
    'toggle': 'aside/toggle',
  })
})
export default class extends Vue {
  private toggle!: () => void;
}
</script>

<style scoped lang="scss">
.el-button {
  height: 2.5rem;
  width: 2.5rem;
  border: none;
  font-size: 1.5rem;
  padding: 0;
}
</style>
