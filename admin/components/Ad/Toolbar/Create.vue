<template>
  <el-button v-granted="roles" type="text" size="large" @click="click">
    <i class="el-icon-plus"></i>
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
  public roles: string[] = ['create']

  click() {
    const path = this.admin.pathByKey('create')
    this.$router.push(path)
  }

}
</script>


<style scoped lang="scss">

</style>
