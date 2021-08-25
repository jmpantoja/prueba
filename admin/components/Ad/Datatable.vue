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
        <el-table v-loading="admin.loading" v-bind="props" @sort-change="sort">
          <slot name="columns"/>

          <slot name="actions">
            <el-table-column width="150" align="center">
              <template v-slot="scope">

                <slot name="action_edit" :on="goToEdit">
                  <el-button type="text"
                             icon="el-icon-edit"
                             @click.native.prevent="goToEdit(scope.row)"/>
                </slot>

                <slot name="action_delete" :on="goToDelete">
                  <el-button type="text"
                             class="btn_delete"
                             icon="el-icon-delete"
                             @click.native.prevent="goToDelete(scope.row)"/>
                </slot>
              </template>
            </el-table-column>


          </slot>

        </el-table>
        <el-pagination
          v-if="page_size > 0"
          layout="total, prev, pager, next"
          :total="total"
          :page-size="page_size"
          :current-page.sync="page"

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

import {Component, Inject, Vue, Watch} from 'nuxt-property-decorator'
import {DefaultSortOptions} from "element-ui/types/table";
import {Form} from "element-ui";
import {mapActions} from "vuex";

import {Admin} from "~/types/admin";
import {denormalizeQuery, normalizeQuery} from "~/src/Grid"
import {FilterList, TableProps, TableQuery} from "~/types/grid";
import {Dataset, Entity} from "~/types/api";


const _ = require("lodash")

@Component({
  name: 'Datatable',
  methods: mapActions({
    saveQuery: 'grid/save'
  })
})
export default class extends Vue {

  @Inject('admin') private admin!: Admin

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
  page: number = 1
  filters: FilterList = {}

  query: TableQuery = {
    page: 1,
    order: undefined,
    filters: undefined
  }

  created() {
    this.query = denormalizeQuery(this.$route.query)
    this.page = this.query.page || 1
  }

  @Watch('page')
  onPageUpdated() {
    this.query.page = this.page
    this.reload()
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


    const query = normalizeQuery(this.query)
    this.persistQuery(query);

    this.admin.get(query)
      .then((dataSet: Dataset) => {
        this.props.data = dataSet.items
        this.total = dataSet.totalItems
        this.updatePageSize()
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
      endpoint: this.admin.endpoint,
      query
    })

    this.$router.push({query})
  }

  public goToEdit(entity: Entity) {
    const path = this.admin.pathByKey('edit', entity)
    this.$router.push({
      path
    })
  }

  public goToDelete(entity: Entity) {
    const path = this.admin.pathByKey('delete', entity)
    this.$router.push({
      path
    })
  }
}
</script>


<style scoped lang="scss">

.datatable {
  height: $panel-height;
  box-sizing: border-box;
  display: flex;

  .btn_delete {
    color: $--color-danger;
  }

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
