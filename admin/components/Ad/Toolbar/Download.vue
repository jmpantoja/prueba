<template>
  <div v-if="length > 0" v-granted="roles" class="admin-toolbar__action">

    <el-button v-if="length ==1"
               type="text"
               size="large"
               @click="download(formats[0])">
      <i class="el-icon-bottom"></i>
    </el-button>

    <el-dropdown v-else type="primary" size="large" @command="download">

      <el-button type="text" size="large">
        <i class="el-icon-bottom"></i>
      </el-button>

      <el-dropdown-menu slot="dropdown">
        <el-dropdown-item
          v-for="(mime, format) in formats"
          :key="mime"
          :command="format">
          .{{ format }}
        </el-dropdown-item>

      </el-dropdown-menu>

    </el-dropdown>

    <el-dialog
      :title="$t('dialog.download.title', {format})"
      :visible.sync="openedDialog"
      width="30%">

      <div v-loading="percentage == 0" element-loading-text="Loading...">
        <el-progress :class="{waiting: percentage==0}" type="circle" :percentage="percentage"/>
      </div>

      <a ref="link" target="_blank"/>

      <span slot="footer" class="dialog-footer">
        <el-button type="primary" :disabled="downloading" @click="onClick">
          {{ $t('dialog.download.button') }}
        </el-button>
      </span>

    </el-dialog>
  </div>
</template>

<script lang="ts">

import {Component, Inject, mixins, Prop, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";
import {QueryGetter, TableQuery} from "~/types/grid";
import AdminAware from "~/mixins/AdminAware";

const parse = require('url-parse');
const _ = require('lodash');

type HTMLLink = { click: any, href: string, download: string };

@Component({
  name: 'Download',
  computed: mapGetters({
    query: 'grid/query'
  })
})
export default class extends mixins(AdminAware) {
  @Prop({required: true, type: Array}) files!: Array<string>
  public roles: string[] = ['export']

  private query!: QueryGetter
  private openedDialog: Boolean = false
  private downloading: boolean = false
  private percentage: number = 0
  private format: string = ''

  private get formats(): object {
    const formats = {
      jsonld: "application/ld+json",
      jsonhal: "application/hal+json",
      jsonapi: "application/vnd.api+json",
      json: "application/json",
      xml: "text/xml",
      yaml: "application/x-yaml",
      csv: "text/csv",
      xlsx: "application/vnd.ms-excel",
    }

    return _.pickBy(formats, (value: string, key: string) => {
      return this.files.includes(key)
    })
  }

  private get length(): number {
    return Object.keys(this.formats).length
  }

  private get link(): HTMLLink {
    const link = (this.$refs['link'] as unknown as HTMLLink)
    return link
  }

  private get downloadUrl(): string {
    const query = this.query(this.admin.endpoint)
    const url = parse(this.admin.endpoint);
    url.set('query', {
      ...query,
      page_size: 1000,
      page: 1
    })
    return url.toString();
  }

  private get fileName(): string {
    const fileName = _.trim(parse(this.downloadUrl).pathname, '/')
    return `${fileName}.${this.format}`
  }

  private get downloadConfig(): object {
    return {
      onDownloadProgress: (event: any) => {
        this.percentage = (100 * event.loaded / event.total)
        if (!event.lengthComputable) {
          this.percentage = 100
        }
      },
      headers: {
        'Accept': _.get(this.formats, this.format, '*/*')
      }
    }
  }

  private async download(format: string) {
    this.openedDialog = true
    this.downloading = true
    this.format = format
    this.percentage = 0

    this.admin.download(this.downloadUrl, this.downloadConfig)
      .then(this.onReady)
  }

  private onReady(response: any) {
    this.downloading = false
    const fileBlobUrl = window.URL.createObjectURL(new Blob([response.data]));
    const fileName = _.trim(parse(this.downloadUrl).pathname, '/')

    this.link.href = fileBlobUrl
    this.link.download = this.fileName
  }

  private onClick() {
    this.link.click()
  }

}
</script>


<style scoped lang="scss">
.el-progress.waiting {
  visibility: hidden;
}

::v-deep .el-dialog__body {
  padding: 0;
  display: flex;
  justify-content: center;
}
</style>
