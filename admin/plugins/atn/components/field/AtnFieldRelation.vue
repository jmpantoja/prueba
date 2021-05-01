<template>
  <atn-field v-on="$listeners">
    <v-autocomplete
      :items="items"
      :multiple="multiple"
      :cache-items="true"
      :clearable="false"
      v-model="data"
      dense
      :chips="chips"
      :deletable-chips="chips"
      return-object
      hide-details
      v-bind="$props">

      <template v-slot:append-outer>
        <atn-admin-form :form="admin.form">
          <template v-slot:activator="{ on, attrs }">
            <v-btn icon color="primary" v-bind="attrs" v-on="on" style="margin-top: -8px">
              <v-icon>mdi-plus</v-icon>
            </v-btn>
          </template>
        </atn-admin-form>
        <v-divider/>
      </template>

      <template v-if="chips" v-slot:selection="{ item }">
        <v-chip close color="info" @click:close="remove(item)">
          {{ itemToString(item) }}
        </v-chip>
      </template>

    </v-autocomplete>
  </atn-field>
</template>

<script>
import AtnField from "@/plugins/atn/components/field/AtnField";
import AtnButton from "@/plugins/atn/components/admin/AtnButton";
import {VAutocomplete} from 'vuetify/lib'

const _ = require('lodash')

const props = VAutocomplete.options.props
delete props.items;
delete props.multiple;
delete props.chips;

export default {
  name: "AtnFieldRelation",
  components: {AtnButton, AtnField},
  mixins: [AtnField],
  inject: ['dispatcher'],
  props: {
    ...props,
    entity: {
      type: String,
      required: true
    },
    mode: {
      type: String,
      required: true,
      validator: (value) => {
        return ['labels', 'single'].includes(value)
      }
    },
    clearable: {
      type: Boolean,
      default() {
        return true
      }
    }
  },
  data() {
    return {
      items: [],
      admin: this.$adminManager.byName(this.entity)
    }
  },
  methods: {
    remove(item) {
      if (!this.multiple) {
        this.data = null
        return
      }
      this.data = this.data.filter((data) => {
        return data.id !== item.id
      });
    },
    itemToString(item) {
      if (typeof this.itemText === 'function') {
        return this.itemText(item)
      }
      return item.name;
    },
    load() {
      this.admin.client.read({page_size: 50})
        .success((response) => {
          this.items = response.items
        }).run()
    }
  },
  computed: {
    multiple() {
      return ['labels'].includes(this.mode)
    },
    chips() {
      return ['labels'].includes(this.mode)
    },
    namespace() {
      return this.entity
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



