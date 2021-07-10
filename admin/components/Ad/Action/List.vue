<template>
  <div class="admin">
    <component :is="components.toolbar"/>
    <el-card>
      <component :is="components.list" :endpoint="endpoint"/>
    </el-card>
  </div>
</template>

<script lang="ts">

import {Context, RouteMeta} from "~/types";
import {Component, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'List',
})
export default class extends Vue {

  async asyncData({route, security}: Context) {
    const metas = (route.meta[0] as RouteMeta)
    security.assert(metas.roles)

    return {
      roles: metas.roles,
      endpoint: metas.endpoint,
      components: metas.components
    }
  }
}
</script>

<style scoped lang="scss">
::v-deep {

  .el-card {
    margin-top: $main-padding;
    padding: 0;
    height: $panel-height;

    .el-card__body {
      padding: 0;
    }
  }


  .el-tabs {
    height: $panel-height;

    .el-tabs__header {

      .el-tabs__nav {
        padding-top: 1em;
      }

      #tab-data {
        display: none;
      }

      .el-tabs__item {
        padding: 0 0.5rem;
      }

      .el-tabs__active-bar {
        background-color: transparent;
      }
    }


    .el-table {
      height: $table-height;
      overflow-y: auto;

      &:before {
        background-color: transparent;
      }
    }

    .el-pagination {
      height: $pagination-height;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }
  }
}


</style>
