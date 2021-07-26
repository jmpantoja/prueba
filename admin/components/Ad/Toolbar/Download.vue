<template>

  <el-dropdown v-granted="roles" v-if="multiple" type="primary" size="large" @command="download">

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
  <el-button v-else-if="single"
             type="text"
             size="large"
             @click="download(formats[0])"
  >
    <i class="el-icon-bottom"></i>
  </el-button>


</template>

<script lang="ts">

import {Component, Inject, Prop, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";
import {Admin} from "~/types/admin";
import {QueryGetter} from "~/types/grid";

const parse = require('url-parse');

@Component({
  name: 'Download',
  computed: mapGetters({
    query: 'grid/query'
  })
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Array}) formats!: []

  public roles: string[] = ['export']

  private query!: QueryGetter

  private get single(): boolean {
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

    const url = parse(this.admin.endpoint + `.${format}`);
    url.set('query', this.downloadQuery())

    return url.toString();
  }

  private downloadQuery() {
    const query = this.query(this.admin.endpoint)

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
