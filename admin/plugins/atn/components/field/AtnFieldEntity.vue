<template>
  <atn-field :label="label">
    <v-autocomplete
      v-model="data"
      v-bind="$props"
      v-on="$listeners"

      dense
      return-object
      hide-details
      label=""

      :items="items"
      :multiple="false"
      :cache-items="true"
      :chips="false"
    >

      <template v-slot:prepend-item>
        <atn-admin-form :form="admin.form">
          <template v-slot:activator="{on, namespace}">
            <v-btn block text color="primary" v-on="on">
              {{ t('form.title.create', {}, namespace) }}
            </v-btn>
          </template>

        </atn-admin-form>
        <v-divider/>
      </template>
    </v-autocomplete>

  </atn-field>
</template>

<script>
import dataInput from "@/plugins/atn/components/form/mixins/dataInput";

import AtnButton from "@/plugins/atn/components/admin/AtnButton";
import {VAutocomplete} from 'vuetify/lib'

const _ = require('lodash')

const props = VAutocomplete.options.props
delete props.items;
delete props.multiple;
delete props.chips;

export default {
  name: "AtnFieldEntity",
  components: {AtnButton},
  mixins: [dataInput],
  inject: ['dispatcher', 'namespace'],
  props: {
    ...props,
    entity: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      items: [],
      admin: this.$adminManager.byName(this.entity)
    }
  },
  methods: {
    show() {
      this.admin.form.show()
    },
    load() {
      this.admin.client.read({page_size: 25})
        .success((response) => {
          this.items = response.items
          this.$emit('load', this.items)
        }).run()

    }
  },
  mounted() {
    const event = `${this.entity}.post.save`
    this.dispatcher.on(event, () => {
      this.load()
    })
    this.load()
  }
}

</script>

<style scoped lang="scss">
::v-deep .v-input__slot {
  display: flex;
  flex-direction: column;
  align-items: flex-start;

  .v-autocomplete {
    width: 100%;
  }

  .v-btn {
    margin-top: 0.5em;
  }
}
</style>



