<template>
  <el-tabs v-model="tab" tab-position="left">

    <el-tab-pane name="filters">
      <el-button slot="label" circle type="text">
        <i class="fas el-icon-fa-search"></i>
      </el-button>

      <el-form
        v-model="filters"
        label-position="left"
        label-width="100px">

        <slot name="filters" :filters="filters"/>

        <el-form-item>
          <el-button type="primary" @click="filter">Submit</el-button>
          <!--                <el-button @click="resetForm('ruleForm')">Reset</el-button>-->
        </el-form-item>
      </el-form>


    </el-tab-pane>

    <el-tab-pane name="data">
      <el-table v-loading="loading" v-bind="props" @sort-change="sort">
        <slot name="columns"/>
      </el-table>
      <el-pagination
        v-if="page_size > 0"
        layout="total, prev, pager, next"
        :total="total"
        :page-size="page_size"
        :current-page.sync="query.page"
      />
    </el-tab-pane>

  </el-tabs>

</template>

<script lang="ts">

import {Component, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {DefaultSortOptions} from "element-ui/types/table";
import {AxiosResponse} from "axios"
import {normalizeQuery} from "~/utils/grid"
import {FilterList, TableProps, TableQuery} from "~/types";
const _ = require("lodash")

@Component({
  name: 'Datatable',
})
export default class extends Vue {
  @Prop({required: true, type: String}) endpoint!: string

  tab: string = 'data'

  props: TableProps = {
    stripe: true,
    height: "yes",
    data: []
  }

  loading: boolean = false
  total: number = 0
  page_size: number = 0
  filters: FilterList = {}

  query: TableQuery = {
    page: 1,
    order: undefined,
    filters: undefined
  }


  @Watch('query', {deep: true})
  updateQuery() {
    this.reload()
  }

  fetch() {
    this.reload()
  }

  sort({order, prop}: DefaultSortOptions) {
    this.$set(this.query, 'order', {order, prop})
  }

  filter() {
    this.$set(this.query, 'filters', _.cloneDeep(this.filters))
    this.tab = 'data'
  }

  reload() {
    this.loading = true
    const query = normalizeQuery(this.query)

    this.$api.GET(this.endpoint, query)
      .then((response: AxiosResponse) => {
        this.props.data = response.data['hydra:member']
        this.total = response.data['hydra:totalItems']

        this.page_size = this.page_size > 0 ? this.page_size : this.props.data.length
        this.loading = false
      })
      .catch((error: Error) => {
        this.loading = false
        this.$message({
          dangerouslyUseHTMLString: true,
          showClose: true,
          message: `<strong>${error.message}</strong>`,
          type: 'error'
        });
      })
  }

}
</script>


<style scoped>

</style>
