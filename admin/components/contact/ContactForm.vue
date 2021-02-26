<template>
  <crud-form :crud="crud" :schema="schema" :width="1000" :title="title"/>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";
import CrudForm from "~/plugins/admin/components/crud/CrudForm.vue";
import {computed} from "@nuxtjs/composition-api";
import VDate from "~/plugins/admin/components/form/VDate.vue";
import VFullname from "~/components/types/VFullname.vue";


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
      title: computed(() => {
        return context.i18n.t('admin.contact.edit')
      }),
      schema_XX: {
        tabs: [
          {
            label: 'tab1',
            rows: [
              {
                cols: 6,
                offset: 0,
                fields: {
                  fullName: {label: 'Nombre Completo', type: VFullname},
                  birthDate: {label: 'Fec. Nacimiento', type: VDate},
                }
              }, {
                cols: 3,
                break: true,
                fields: {
                  birthDate: {label: 'Fec. Nacimiento', type: VDate},
                }
              }
            ]
          }
        ]
      },
      schema: {
        rows: [
          {
            cols: 6,
            offset: 0,
            fields: {
              fullName: {label: 'Nombre Completo', type: VFullname},
            }
          }, {
            cols: 3,
            offset: 3,
            break: true,
            fields: {
              birthDate: {label: 'Fec. Nacimiento', type: VDate},
            }
          }
        ]
      },
    }
  }
}
</script>
