<template>
  <el-container class="is-vertical">
    <nuxt/>
  </el-container>
</template>

<style scoped lang="scss">

.el-container.is-vertical {
  min-height: 100vh;

  .el-main {
    background-color: $main-background-color;
  }
}
</style>

