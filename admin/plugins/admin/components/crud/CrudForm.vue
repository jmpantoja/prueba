<template>
  <crud-dialog :dialog="form" :width="width">
    <template slot="content">
      <v-form ref="form"
              v-model="form.valid"
              lazy-validation
              onSubmit="return false;"
              @keyup.enter.native="onEnter">

        <v-row v-for="(row, rowIndex) in layout.rows" :key="rowIndex">
          <v-col v-for="(col, colIndex) in row" :key="colIndex" v-bind="col.props">
            <template v-for="(field, name) in col.fields">
              <v-wrapper :key="name" :field="field" v-model="item[name]"/>
            </template>
          </v-col>
        </v-row>

        <v-tabs v-model="tab">
          <v-tab :class="{'error--text': errorTabs[`tab${tabIndex}`]}" v-for="(tab, tabIndex) in layout.tabs"
                 :key="tabIndex">
            {{ tab.label }}
          </v-tab>

          <v-tabs-items ref="tabItems" v-model="tab">
            <v-tab-item
              eager
              v-for="(tab, tabIndex) in layout.tabs"
              :key="tabIndex">

              <v-row v-for="(row, rowIndex) in tab.rows" :key="rowIndex">
                <v-col v-for="(col, colIndex) in row" :key="colIndex" v-bind="col.props">
                  <template v-for="(field, name) in col.fields">
                    <v-wrapper :tab="tabIndex" :key="name" :field="field" v-model="item[name]"/>
                  </template>
                </v-col>
              </v-row>

            </v-tab-item>
          </v-tabs-items>
        </v-tabs>

      </v-form>
    </template>

    <template slot="actions">
      <slot name="btn_cancel" :item="item">
        <v-btn color="primary" text @click="onCancel(item)">
          {{ $t('dialog.cancel') }}
        </v-btn>
      </slot>
      <slot name="btn_save" :item="item">
        <v-btn :disabled="!form.valid" color="primary" text @click="onSave(item)">
          {{ $t('dialog.save') }}
        </v-btn>
      </slot>
    </template>
  </crud-dialog>
</template>

<script>

import {Crud} from "~/plugins/admin/types";
import CrudDialog from "~/plugins/admin/components/crud/CrudDialog.vue";
import VField from "~/plugins/admin/components/form/VField";
import VWrapper from "~/plugins/admin/components/form/VWrapper";
import FormValidator from "~/plugins/admin/src/crud/FormValidator";


const _ = require('lodash')

export default {
  name: 'CrudForm',
  components: {VWrapper, VField, CrudDialog},
  props: {
    crud: {
      type: Crud,
      required: true
    },
    schema: {
      type: Object,
      required: true
    },
    width: {
      type: Number,
      default() {
        return 700
      }
    },
    title: {
      type: String
    }
  },
  data() {
    return {
      tab: 0,
      errorTabs: {},
      errorBag: {}
    }
  },
  computed: {
    item() {
      return this.crud.form.item
    },
    form() {
      return this.crud.form
    },
    layout() {
      const formLayout = new FormValidator(this.schema)
      return formLayout.instance
    }
  },
  methods: {
    onSave(item) {
      if (!this.$refs.form.validate()) {
        return;
      }
      this.form.ok(item)
    },
    onCancel(item) {
      this.form.close()
      return;
    },
    onEnter(item) {
      this.onSave(this.item)
      return;
    },
    onChangeInput(input, error) {
      const getTab = (input) => {
        var item = input
        var tab = item.$attrs.tab

        while (item && _.isUndefined(tab)) {
          item = item.$parent
          if (item) {
            tab = item.$attrs.tab
          }
        }
        return tab
      }

      let tab = getTab(input)
      if (_.isUndefined(tab)) {
        return
      }

      tab = `tab${tab}`
      if (!this.errorBag[tab]) {
        this.errorBag[tab] = {}
      }

      this.errorBag[tab][input._uid] = error
      this.errorTabs[tab] = Object.values(this.errorBag[tab]).includes(true)
    }
  },
  watch: {
    item() {
      this.tab = 0
      this.$refs.form.inputs.forEach((input) => {
        this.onChangeInput(input, !input.validate())
      })
    },
  },
  mounted() {
    this.$refs.form.inputs.forEach((input) => {
      input.$on('update:error', (error) => {
        this.onChangeInput(input, error)
      })
    })
  }
}
</script>

<style lang="scss">
dl.v-fieldset {
  dd {
    margin-top: 1em;
    font-weight: bold;
    font-size: 1.2em;
  }

  dt {
    .v-input {
      padding-top: 0;
      margin-top: 6px;
    }

    .v-input .v-input__control div.v-input__slot {
      div.v-input {
        margin-right: 1em;
      }

      div.v-input:last-child {
        margin-right: 0;
      }

    }
  }
}
</style>
