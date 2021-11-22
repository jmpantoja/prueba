<template>
  <el-menu
    :default-active="localePath('home')"
    :router="true"
    :collapse="closed"
    :collapse-transition="true"
    text-color="#fff"
    active-text-color="#ffd04b"
    background-color="#41403d"
    v-bind="$attrs"
  >
    <el-menu-item :index="localePath('home')">
      <i class="el-icon-menu"></i>
      <span>{{ $t('menu.home') }}</span>
    </el-menu-item>


    <el-menu-item :index="localePath('play')">
      <i class="el-icon-position"></i>
      <span>{{ $t('menu.play') }}</span>
    </el-menu-item>

    <el-menu-item :index="localePath('rating')">
      <i class="el-icon-medal"></i>
      <span>{{ $t('menu.rating') }}</span>
    </el-menu-item>

    <el-menu-item :index="localePath('stats')">
      <i class="el-icon-s-data"></i>
      <span>{{ $t('menu.stats') }}</span>
    </el-menu-item>
  </el-menu>
</template>

<script>
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  inheritAttrs: false,
  name: 'Menu',
  computed: mapGetters({
    'closed': 'aside/closed',
  })

})
export default class extends Vue {
  onOpen() {
  }

  onClose() {
  }

}

</script>

<style scoped lang="scss">
//.el-menu {
//  border-right: solid 1px transparent;
//  position: absolute;
//  height: 100%;
//  z-index: 1;
//}
//
//.el-menu:not(.el-menu--collapse) {
//  width: 15rem;
//}
</style>
