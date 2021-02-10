<template>
  <crud-dialog :dialog="form">
    <template slot="content">
      <v-form ref="vform" v-model="form.valid" lazy-validation onSubmit="return false;"
              @keyup.enter.native="onEnter">

        <template v-for="(field, name) in schema.fields">
          <component :is="field.type" v-model="item[name]"/>
        </template>

        <!--        <slot name="fields" :item="item"/>-->
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
<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import {ref} from "@vue/composition-api";
import {computed, watch} from "@nuxtjs/composition-api";
import CrudDialog from "~/plugins/admin/components/crud/CrudDialog.vue";

const _ = require('lodash')

export default {
  name: 'CrudForm',
  components: {CrudDialog},
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
        return 520
      }
    },
    title: {
      type: String
    }
  },
  setup(props: { crud: Crud, schema: object }, context) {
    const vform = ref({})
    watch(() => props.crud.form.opened, () => {
      _.invoke(vform.value, 'resetValidation')
    })

    const form = props.crud.form
    form.schema = props.schema

    return {
      vform: vform,
      form: props.crud.form,
      item: computed(() => {
        return props.crud.form.item
      }),
      onSave(item: object) {
        if (!this.vform.validate()) {
          return;
        }
        this.form.ok(item)

        return;
      },
      onCancel(item: object) {
        this.form.close()
        return;
      },
      onEnter(item: object) {
        this.onSave(this.item)
        return;
      },

    }
  }
}
</script>

<style lang="scss">

</style>
