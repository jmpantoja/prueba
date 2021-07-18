<template>

  <div class="datatable">
    <div class="menu">
      <el-button type="text" @click="toggle">
        <i class="fas el-icon-fa-search"></i>
      </el-button>
      <el-button type="text" @click="reset">
        <i class="fas el-icon-fa-sync-alt"></i>
      </el-button>
    </div>
    <div class="wrapper">
      <div class="panel data">
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
      </div>
      <div class="panel overlay" :class="{visible:show_filters}"/>

      <div class="panel filters"
           :class="{visible:show_filters}"
           v-clickoutside="outside">
        <header>
          <el-button class="close-btn" circle type="text" @click="hide">
            <i class="el-icon-close"></i>
          </el-button>
        </header>

        <el-form
          ref="filters"
          :model="filters"
          label-position="left"
          label-width="6rem">

          <slot name="filters" :filters="filters"/>

          <footer>
            <el-form-item>
              <el-button @click="reset">{{ $t('buttons.reset') }}</el-button>
              <el-button type="primary" @click="filter">{{ $t('buttons.filter') }}</el-button>
            </el-form-item>
          </footer>
        </el-form>
      </div>
    </div>
  </div>


</template>

<script lang="ts">

import {Component, mixins, Watch} from 'nuxt-property-decorator'
import {DefaultSortOptions} from "element-ui/types/table";
import {AxiosResponse} from "axios"
import {denormalizeQuery, normalizeQuery} from "~/utils/grid"
import {FilterList, TableProps, TableQuery} from "~/types";
import {Form} from "element-ui";
import {mapActions} from "vuex";
import Context from "~/mixins/Context"

const _ = require("lodash")

@Component({
  name: 'Datatable',
  methods: mapActions({
    saveQuery: 'grid/save'
  })
})
export default class extends mixins(Context) {

  saveQuery!: Function
  tab: string = 'data'
  show_filters: boolean = false

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


  created() {
    this.query = denormalizeQuery(this.$route.query)
  }


  @Watch('query', {deep: true})
  onQueryUpdated() {
    this.reload()
  }

  toggle() {
    this.show_filters = !this.show_filters
  }

  outside() {
    const target = (event?.target as Element)

    if (target.closest('.el-popper')) {
      return
    }
    this.hide()
  }

  hide() {
    this.show_filters = false
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
    this.hide()
  }

  reset() {
    const form = (this.$refs['filters'] as Form)
    form.resetFields()
    this.hide()
    this.query = {
      page: 1,
    }
  }

  reload() {
    if (this.loading) {
      return
    }

    this.loading = true
    const query = normalizeQuery(this.query)

    this.persistQuery(query);

    this.$api.GET(this.endpoint, query)
      .then((response: AxiosResponse) => {
        this.props.data = response.data['hydra:member']
        this.total = response.data['hydra:totalItems']
        this.updatePageSize()

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

  private updatePageSize() {

    let candidate = (this.query.page_size as number) || this.props.data.length

    if (candidate < 1) {
      candidate = 10
    }

    if (candidate !== this.page_size) {
      this.page_size = candidate
    }
  }

  private persistQuery(query: {}) {

    this.saveQuery({
      endpoint: this.endpoint,
      query
    })

    this.$router.push({query})
  }
}
</script>


<style scoped lang="scss">

.datatable {
  height: $panel-height;
  box-sizing: border-box;
  display: flex;

  .menu {
    display: flex;
    flex-direction: column;

    width: 50px;
    border-right: 1px solid #DCDFE6;
    background-color: white;
    position: relative;
    z-index: 9;

    .el-button {
      margin: 2px 0;
    }
  }

  .wrapper {
    flex-grow: 1;
    position: relative;

    .panel {
      position: absolute;

      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    .panel.visible {
      left: 0;

    }

    .filters {
      background-color: white;
      left: -5000px;
      width: 40%;
      transition: left 200ms;
      box-shadow: 3px 3px 5px 6px #cccccc; /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
      box-shadow: 0 2px 12px 0 rgba(0, 0, 0, .6);
      display: flex;
      flex-direction: column;


      header {
        display: flex;
        justify-content: flex-end;

        .close-btn {
          color: #666;
          font-size: 1.1rem;
        }
      }

      .el-form {
        padding: 1em;
        flex-grow: 1;

        display: flex;
        flex-direction: column;

        footer {
          flex-grow: 1;
          display: flex;
          align-items: flex-end;
          justify-content: flex-end;

          padding: 0;

          .el-form-item {
            margin: 0;
          }
        }
      }

    }

    .overlay {
      background-color: rgba(0, 0, 0, .1);
      left: -5000px;
      width: 100%;
    }

    .data {
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


</style>
