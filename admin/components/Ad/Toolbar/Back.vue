<template>
  <el-button v-granted="roles" type="text" size="large" @click="click">
    <i class="el-icon-back"></i>
  </el-button>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import AdminAware from "~/mixins/AdminAware";

var parse = require('url-parse');

@Component({
  name: 'Create'
})
export default class extends mixins(AdminAware) {
  public roles: string[] = ['read']

  click() {
    const previous = this.$nuxt.context.from
    const list = this.admin.pathByKey('list')

    if (previous.path !== list) {
      this.$router.push(list)
      return
    }

    this.$router.push(this.$nuxt.context.from.fullPath)
  }

}
</script>


<style scoped lang="scss">

</style>
