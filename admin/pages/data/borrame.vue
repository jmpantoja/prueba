<template>
  <div style="padding: 5em">

    <v-card>
      <v-card-title>

      </v-card-title>
      <v-card-text>


        <v-form v-model="valid"
                ref="form"
                onSubmit="return false;">


          <div class="example">
            <h2>Crud</h2>
            <p>Maestro / detalles</p>

            <atn-field-wrapper
              label="name"
              :multiple="true"
              type="atn-field-fullname"
              v-model="data"
            />
            <code>
              {{ data }}
            </code>
          </div>


          <div class="example" v-for="(example, key) in examples">
            <h2>{{ key }}</h2>
            <p>{{ example.desc }}</p>

            <atn-field-wrapper
              label="genres"
              :type="example.type"
              :props="{entity:'directors', itemText:itemToText, clearable: true}"
              v-model="example.data"
            />
            <code>
              {{ example.data }}
            </code>
          </div>

        </v-form>

      </v-card-text>
      <v-card-actions>
        <v-spacer/>
        <v-btn color="primary" :disabled="!valid">submit</v-btn>

      </v-card-actions>

    </v-card>

  </div>
</template>

<script>
import AtnAdmin from "../../plugins/atn/components/admin/AtnAdmin";
import AtnFieldWrapper from "@/plugins/atn/components/form/AtnFieldWrapper";
import VueListboxMultiselect from '@/plugins/atn/components/field/AtnFieldEntityListbox';
import AtnFieldEntityListbox from '@/plugins/atn/components/field/AtnFieldEntityListbox';
import AtnField from "@/plugins/atn/components/form/AtnField";

export default {
  components: {AtnFieldEntityListbox, AtnField, AtnFieldWrapper, AtnAdmin, VueListboxMultiselect},
  provide() {
    return {
      dispatcher: this.admin.dispatcher,
      namespace: this.admin.namespace
    }
  },
  mounted() {
    this.errorBag = this.$refs['form'].errorBag
  },
  data() {
    return {
      valid: null,
      data: [],
      examples: {
        // single: {
        //   desc: 'Elegir un registro de otra tabla',
        //   type: 'atn-field-entity',
        //   data: null
        // },
        // tags: {
        //   desc: 'Elegir varios registros de otra tabla, con labels',
        //   type: 'atn-field-entity-tags',
        //   data: []
        // },
        // listbox: {
        //   desc: 'Elegir varios registros de otra tabla, con listbox',
        //   type: 'atn-field-entity-listbox',
        //   data: [{
        //     "@type": "Director",
        //     "@id": "/directors/01792d18-31dc-1272-edb3-12619793047b",
        //     "id": "01792d18-31dc-1272-edb3-12619793047b",
        //     "name": {"name": "Martin", "lastName": "Scorsese"}
        //   }]
        // },
        // crud: {
        //   desc: 'Añadir/Modificar/Borrar entidades de un agregado (maestro / detalle, pedido / lineas de pedido)',
        //   mode: 'labels',
        //   data: []
        // },
      },

      admin: this.$adminManager.byName('directors')
    }
  },
  methods: {
    itemToText(item) {
      const fullName = item.name || {}
      return `${fullName.lastName}, ${fullName.name}`
    }
  }
}
</script>

<style scoped lang="scss">


::v-deep .example {
  margin-bottom: 2em;
  border-bottom: dashed 1px #999;
  padding-bottom: 3em;

  p {
    margin-top: 3px;
    color: #333;
    font-size: 110%;
  }

  code {
    margin-top: 1em;
    display: block;
  }
}

</style>
