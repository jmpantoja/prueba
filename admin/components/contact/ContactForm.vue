<template>
  <crud-form :crud="crud" :width="700" :title="title">
    <template v-slot:fields="{item}">
      <v-row>
        <v-col cols="6">
          <v-text-field v-model="item.fullName.firstName" :rules="nameRules"/>
        </v-col>
        <v-col cols="6">
          <v-text-field v-model="item.fullName.lastName"/>
        </v-col>
      </v-row>

    </template>
  </crud-form>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import CrudForm from "~/plugins/admin/components/crud/CrudForm.vue";
import {computed} from "@nuxtjs/composition-api";

export default {
  name: 'ContactForm',
  components: {CrudForm},
  props: {
    crud: {
      type: Crud,
      required: true
    }
  },
  setup(props) {
    const context = props.crud.context

    return {
      nameRules: [
        value => !!value || 'Name is required',
        value => (value && value.length <= 10) || 'Name must be less than 10 characters',
      ],
      title: computed(() => {
        return context.i18n.t('admin.contact.edit')
      })
    }
  }
}
</script>
