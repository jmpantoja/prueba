<template>
  <el-header>
    <div class="logo aside-collapsable" :class="{'aside-collapsable__collapsed':closed}">
      aqui el logo
    </div>

    <ad-panel-toggle/>

    <div class="right-menu">
      <ad-panel-language-switcher/>
      <ad-panel-profile/>
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

  .right-menu {
    flex: 2;
    display: flex;
    flex-direction: row-reverse;

  }

}

.logo {
  padding: 1em;
  box-sizing: border-box;
}


</style>
