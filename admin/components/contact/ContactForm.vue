<template>
  <crud-form :crud="crud" :schema="schema" :width="700" :title="title">

<!--    <template v-slot:fields="{item}">-->

<!--      &lt;!&ndash;      <v-row>&ndash;&gt;-->
<!--      &lt;!&ndash;        <v-col cols="6">&ndash;&gt;-->
<!--      &lt;!&ndash;          <v-text-field v-model="item.fullName.firstName" :rules="nameRules"/>&ndash;&gt;-->
<!--      &lt;!&ndash;        </v-col>&ndash;&gt;-->
<!--      &lt;!&ndash;        <v-col cols="6">&ndash;&gt;-->
<!--      &lt;!&ndash;          <v-text-field v-model="item.fullName.lastName"/>&ndash;&gt;-->
<!--      &lt;!&ndash;        </v-col>&ndash;&gt;-->
<!--      &lt;!&ndash;      </v-row>&ndash;&gt;-->

<!--      &lt;!&ndash;      <v-row>&ndash;&gt;-->
<!--      &lt;!&ndash;        <v-col cols="6">&ndash;&gt;-->

<!--      &lt;!&ndash;        </v-col>&ndash;&gt;-->
<!--      &lt;!&ndash;      </v-row>&ndash;&gt;-->
<!--    </template>-->

  </crud-form>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import CrudForm from "~/plugins/admin/components/crud/CrudForm.vue";
import {computed} from "@nuxtjs/composition-api";
import InputDate from "~/plugins/admin/components/form/InputDate.vue";
import VFullname from "~/components/types/VFullname.vue";

export default {
  name: 'ContactForm',
  components: {InputDate, CrudForm},
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
      }),
      schema: {
        fields: {
          fullName: {
            type: VFullname
          },
          birthDate: {
            type: InputDate
          }
        }
      }
    }
  }
}
</script>
