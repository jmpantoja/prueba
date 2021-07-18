<template>
  <ad-toolbar title="admin.genre.title">

    <ad-toolbar-download :context="context"
                         :formats="['xlsx', 'csv', 'yaml']"
                         :roles="['admin']"/>

    <ad-toolbar-create :context="context"/>

  </ad-toolbar>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import Context from '~/mixins/Context'

@Component({
  name: 'GenreToolbar'
})
export default class extends mixins(Context) {

}
</script>

<style scoped lang="scss">

::v-deep .el-button {
  font-size: 2.5rem;
  margin-left: 1rem;
}
</style>
