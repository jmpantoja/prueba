<template>
  <v-dialog v-model="form.opened" :width="width">
    <v-card :loading="form.loading">
      <v-card-title v-if="title">
        {{ title }}
      </v-card-title>
      <v-card-text>

        <v-form ref="vform" v-model="form.valid" lazy-validation onSubmit="return false;"
                @keyup.enter.native="onEnter">
          <slot name="fields" :item="item"/>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer/>

        <slot name="actions" :item="item">
          <slot name="action_cancel" :item="item">
            <v-btn color="primary" text @click="onCancel(item)">
              {{ $t('form.cancel') }}
            </v-btn>
          </slot>
          <slot name="action_save" :item="item">
            <v-btn :disabled="!form.valid" color="primary" text @click="onSave(item)">
              {{ $t('form.save') }}
            </v-btn>
          </slot>
        </slot>

      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import {ref} from "@vue/composition-api";
import {computed, watch} from "@nuxtjs/composition-api";

const _ = require('lodash')

export default {
  name: 'CrudForm',
  props: {
    crud: {
      type: Crud,
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
  setup(props: { crud: Crud }, context) {
    const vform = ref({})

    watch(()=>props.crud.form.opened, ()=>{
      _.invoke(vform.value, 'resetValidation')
    })

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

        const id = _.get(item, 'id');
        if (id) {
          this.form.update(item)
          return;
        }

        this.form.create(item)
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
