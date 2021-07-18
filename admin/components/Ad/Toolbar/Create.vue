<template>
  <el-button type="text" size="large" @click="click">
    <i class="el-icon-plus"></i>
  </el-button>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import Context from "~/mixins/Context";

var parse = require('url-parse');

@Component({
  name: 'Create'
})
export default class extends mixins(Context) {

  click() {
    const action = this.context.actions.create;
    const path = this.localePath(action)

    this.$router.push(path)
  }

}
</script>


<style scoped lang="scss">

</style>
