import Vue from 'vue'

import _ from 'lodash'
import admin from '~/admin/admin'

function install (Vue, options) {
  Vue.mixin({
    computed: {
      entity () {
        return this.$route.params.entity
      },
      admin () {
        const l = this.localePath.bind(this)
        return {
          entity: this.entity,
          dataList: admin[this.entity].dataList,
          form: admin[this.entity].form,
          url (params) {
            params = _.merge(params, {
              entity: this.entity
            })

            let name = 'data-action-entity'
            if (params.id) {
              name = 'data-action-entity-id'
            }

            return l({
              name,
              params
            })
          }
        }
      }
    },
    methods: {
      isEmpty (value) {
        value = value || {}
        if (typeof value === 'number' && value !== 0) {
          return false
        }

        return Object.keys(value).length <= 0
      },
      filter (value) {
        return _.filter(value)
      }
    }
  })
}

Vue.use({ install })
