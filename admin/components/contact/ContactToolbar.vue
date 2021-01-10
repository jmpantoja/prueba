<template>
  <crud-toolbar :crud="crud" :title="title">
    sss
  </crud-toolbar>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import CrudForm from "~/plugins/admin/components/crud/CrudForm.vue";
import {computed} from "@nuxtjs/composition-api";
import CrudToolbar from "~/plugins/admin/components/crud/CrudToolbar.vue";

export default {
  name: 'ContactToolbar',
  components: {CrudToolbar},
  props: {
    crud: {
      type: Crud,
      required: true
    }
  },
  setup(props) {
    const context = props.crud.context
    return {
      title: computed(() => {
        return context.i18n.t('admin.contact.title')
      })
    }
  }
}
</script>
