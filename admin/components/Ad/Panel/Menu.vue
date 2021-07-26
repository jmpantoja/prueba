<template>
  <el-aside class="aside-collapsable" :class="{'aside-collapsable__collapsed':closed}">
    <el-scrollbar>
      <el-menu :router="true" :default-active="$route.path" :collapse="closed" :collapse-transition="false"
               @select="select">

        <template v-for="(rule, index) in menu">
          <el-submenu
            v-if="rule.children && rule.children.length > 0"
            :key="index"
            :index="localePath(rule.path)">
            <template slot="title">
              <i :class="rule.icon"/>
              <span slot="title">{{ $t(rule.title) }}</span>
            </template>

            <el-menu-item
              v-for="(child, index) in rule.children"
              :index="localePath(child.path)"
              :key="index"
            >
              <span slot="title">{{ $t(child.title) }}</span>
            </el-menu-item>
          </el-submenu>

          <el-menu-item
            v-else
            :index="localePath(rule.path)"
            :key="index"
          >
            <i :class="rule.icon"/>
            <span slot="title">{{ $t(rule.title) }}</span>
          </el-menu-item>

        </template>
      </el-menu>

    </el-scrollbar>
  </el-aside>
</template>


<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from 'vuex'

@Component({
  name: 'Menu',
  computed: mapGetters({
    'closed': 'aside/closed',
    'menu': 'menu/menu',
  })
})
export default class extends Vue {
  select(path: string, paths: Array<string>) {
//    console.log(path, paths)
  }
}
</script>

<style scoped lang="scss">
.el-aside {
  border: $--border-base;
}

.el-scrollbar {
  box-sizing: border-box;
  height: calc(100vh - #{$header-height} - 2px);

  el-scrollbar__wrap {
    overflow-x: auto;
  }
}

.el-menu {
  border: none;
}
</style>
