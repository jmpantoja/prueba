<template>
  <el-button v-granted="roles" type="text" size="large" @click="click">
    <i class="el-icon-back"></i>
  </el-button>
</template>

<script lang="ts">

import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";

var parse = require('url-parse');

@Component({
  name: 'Create'
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  public roles: string[] = ['list']

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
