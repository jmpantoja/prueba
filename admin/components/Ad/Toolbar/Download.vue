<template>

  <el-dropdown v-if="allowed && multiple" type="primary" size="large" @command="download">
    <el-button type="text" size="large">
      <i class="el-icon-bottom"></i>
    </el-button>

    <el-dropdown-menu slot="dropdown">
      <el-dropdown-item
        v-for="format in formats"
        :key="format"
        :command="format">
        .{{ format }}
      </el-dropdown-item>

    </el-dropdown-menu>

  </el-dropdown>
  <el-button v-else-if="allowed && single"
             type="text"
             size="large"
             @click="download(formats[0])"
  >
    <i class="el-icon-bottom"></i>
  </el-button>


</template>

<script lang="ts">

import {Component, mixins, Prop} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";
import Context from "~/mixins/Context";
import {QueryGetter} from "~/types";

const parse = require('url-parse');

@Component({
  name: 'Download',
  computed: mapGetters({
    query: 'grid/query'
  })
})
export default class extends mixins(Context) {
  query!: QueryGetter
  @Prop({required: true, type: Array}) formats!: []

  private get single(): boolean {
    console.log(this.formats.length)
    return (this.formats.length as number) === 1
  }

  private get multiple(): boolean {
    return this.formats.length > 1
  }

  public download(format: string) {
    const url = this.urlByFormat(format);

    window.open(url, '_blank');
  }


  private urlByFormat(format: string): string {
    const url = parse(this.endpoint + `.${format}`);
    url.set('query', this.downloadQuery())

    return url.toString();
  }

  private downloadQuery() {
    const query = this.query(this.endpoint)

    return {
      ...query,
      page_size: 5000,
      page: 1
    }
  }
}
</script>


<style scoped lang="scss">

</style>
