<template>
  <v-container>
    <v-toolbar class="ma-3 toolbar" flat>
      <v-toolbar-title v-if="computedToolbar.title" class="text-h3 font-weight-thin" style="height: 1.5em;">
        {{ computedToolbar.title }}
      </v-toolbar-title>

      <v-spacer/>
      <template v-for="(action, key) in computedToolbar.actions" v-key="key">
        <v-menu v-if="!isEmpty(action.items)" :key="key" offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-btn icon color="primary" v-bind="attrs" v-on="on">
              <v-icon>{{ action.icon }}</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item
                v-for="(item, index) in filter(action.items)"
                :key="index"
                @click="exec(action.callback, item, action)"
            >
              <v-list-item-action>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <span>{{ item.text }}</span>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-menu>

        <v-btn v-else-if="action" :key="key" icon color="primary" @click="exec(action.callback, action)">
          <v-icon>{{ action.icon }}</v-icon>
        </v-btn>
      </template>
    </v-toolbar>

    <v-card class="elevation-3 ma-3">
      <v-data-table
          fixed-header
          height="calc(100vh - 340px)"
          hide-default-footer
          :headers="computedHeaders"
          :items="items"
          :options.sync="options"
          :items-per-page="itemsPerPage"
          :page.sync="page"
          @page-count="pageCount = $event"
      >
        <template
            v-for="header in computedHeaders "
            :slot="'header.' + header.value"
            v-key="header.value"
        >
          <slot :name="'header.' + header.value" :header="header">
            {{ header.text }}
          </slot>
        </template>

        <template
            v-for="header in computedHeaders"
            :slot="'item.' + header.value"
            v-key="header.value"
            slot-scope="{item}"
        >
          <slot :name="'item.' + header.value" :item="item" :header="header">
            {{ item[header.value] }}
          </slot>
        </template>

        <template :slot="'item.__actions'" slot-scope="{item}">
          <slot :name="'item.__actions'" :item="item">
            <v-btn
                v-for="(action, key) in computedActions"
                :key="key"
                :color="action.color"
                icon
                @click="exec(action.callback, item, action)"
            >
              <v-icon small>
                {{ action.icon }}
              </v-icon>
            </v-btn>
          </slot>
        </template>
      </v-data-table>
      <div v-if="pageCount > 1" class="pa-2 text-center">
        <v-pagination
            v-model="page"
            class="ma-2"
            :length="pageCount"
            total-visible="6"
        />
      </div>
    </v-card>
  </v-container>
</template>

<script>
import _ from 'lodash'

export default {
  name: 'Grid',
  props: {
    toolbar: {
      type: Object,
      default: () => ({})
    },
    headers: {
      type: Array,
      default: () => []
    },
    actions: {
      type: Object,
      default: () => []
    },
    items: {
      type: Array,
      default: () => []
    },
    itemsPerPage: {
      type: Number,
      default: () => 10
    }
  },
  data () {
    return {
      page: 1,
      pageCount: 0,
      options: {}
    }
  },
  computed: {
    computedHeaders () {
      if (this.isEmpty(this.computedActions)) {
        return this.headers
      }

      return [].concat(this.headers, [{
        value: '__actions',
        align: 'right',
        sortable: false
      }])
    },
    computedActions () {
      const actions = {
        edit: {
          name: 'edit',
          icon: 'mdi-pencil',
          callback: this.onEdit
        },
        delete: {
          name: 'delete',
          icon: 'mdi-delete',
          callback: this.onDelete
        }
      }
      return _.merge(actions, this.actions)

    },

    computedToolbar () {
      const toolbar = {
        actions: {
          new: {
            icon: 'mdi-plus',
            callback: this.onNew
          },
          export: {
            icon: 'mdi-arrow-down-bold-outline',
            callback: this.onExport,
            items: {
              pdf: {
                text: '.pdf',
                icon: 'mdi-file-pdf-outline'
              },
              json: {
                text: '.json',
                icon: 'mdi-code-json'
              }
            }
          },
          filter: {
            icon: 'mdi-magnify',
            callback: this.onFilter
          }
        }
      }

      return _.merge(toolbar, this.toolbar)
    }
  },
  methods: {
    exec (callback, ...params) {
      if (typeof callback !== 'function') {
        return
      }
      callback.call(this, ...params)
    },
    onNew () {
      const url = this.admin.url({ action: 'create' })
      this.$router.push(url)
    },
    onExport (item) {
      alert('export grid' + item.text)
    },
    onFilter () {
      alert('filter grid')
    },
    onEdit (item) {
      const url = this.admin.url({
        action: 'edit',
        id: item.id
      })
      this.$router.push(url)
    },
    onDelete (item) {
      alert('delete')
    }
  }
}
</script>

<style scoped>
.toolbar {
  background-color: transparent !important;
}
</style>
