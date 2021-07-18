<template>
  <el-header>
    <div class="logo aside-collapsable" :class="{'aside-collapsable__collapsed':closed}">
      aqui el logo
    </div>

    <div class="left-menu">
      <ad-panel-toggle/>
    </div>

    <div class="right-menu">
      <ad-panel-profile/>
      <ad-panel-language-switcher/>
    </div>
  </el-header>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  name: 'Header',
  computed: mapGetters({
    'closed': 'aside/closed',
  })
})
export default class extends Vue {

}
</script>

<style scoped lang="scss">
.el-header {

  padding: 0;
  background-color: $--color-primary;
  width: 100%;
  height: $header-height !important;

  display: flex;

  align-items: center;
  justify-content: flex-end;

  .left-menu {
    flex: 1;
  }

  .right-menu {
    display: flex;
    justify-content: flex-end;
    flex-direction: row;

    .el-dropdown {
      display: block;
      height: $header-height;

      ::v-deep .el-button {
        height: $header-height;
      }
    }

  }

}

.logo {
  padding: 1em;
  box-sizing: border-box;
}


</style>
