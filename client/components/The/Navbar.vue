<template>
  <el-menu
    default-active="1"
    :router="true"
    v-bind="$attrs"
  >
    <el-menu-item :index="localePath('home')">
      <i class="el-icon-s-home"></i>
      <span>{{ $t('menu.home')}}</span>
    </el-menu-item>
    <el-menu-item :index="localePath('play')">
      <i class="el-icon-position"></i>
      <span>{{ $t('menu.play')}}</span>
    </el-menu-item>

  </el-menu>
</template>


<script lang="ts">
export default {
  inheritAttrs: false,
  name: 'TheNavbar'
}
</script>

<style scoped lang="scss">

.el-menu {
  border: none;
}

</style>
