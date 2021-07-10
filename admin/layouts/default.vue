<template>
  <el-container class="is-vertical">
    <ad-panel-header/>
    <el-container class="is-horizontal">
      <ad-panel-menu/>
      <el-main>
        <nuxt/>
      </el-main>
    </el-container>
  </el-container>
</template>

<style scoped lang="scss">

.el-container.is-vertical {
  min-height: 100vh;

  .el-main {
    background-color: $main-background-color;
    padding: $main-padding;
  }
}
</style>

