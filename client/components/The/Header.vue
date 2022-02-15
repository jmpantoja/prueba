<template>
  <header class="header">
    <div class="logo">
      <the-drawer-toggle/>
      <button-home />
    </div>

    <the-navbar mode="horizontal"/>

    <el-button-group>
      <el-button circle icon="el-icon-edit"></el-button>
      <el-button circle icon="el-icon-share"></el-button>
      <el-button circle icon="el-icon-delete"></el-button>
    </el-button-group>
  </header>
</template>

<script>
import {Component, Vue} from 'nuxt-property-decorator'

@Component({
  inheritAttrs: false,
  name: 'TheHeader',

})
export default class extends Vue {

}

</script>

<style scoped lang="scss">
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 100%;
  padding: 1rem;
  border-bottom: $--border;
}

.el-menu {
  display: none;
}

.logo {
  display: flex;
  height: 100%;
}

.app-menu-toggle {
  display: block;
}

@media screen and (min-width: 65em) {
  .el-menu {
    display: block;
  }

  .app-menu-toggle {
    display: none;
  }
}

</style>
