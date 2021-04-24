<template>
  <atn-field v-bind="$props" v-on="$listeners">

    <v-autocomplete
      :items="items"
      :cache-items="true"
      v-model="data"
      chips
      deletable-chips
      return-object
      hide-details
      v-bind="$props"
    >
      <template v-slot:selection="{ item }">
        <v-chip close color="info" @click:close="remove(item)">
          {{ item.name }}
        </v-chip>
      </template>
    </v-autocomplete>

    <atn-admin-form :form="admin.form">
      <template v-slot:activator="{ on, attrs }">
        <v-btn text color="primary" small v-bind="attrs" v-on="on">
          <v-icon left>mdi-plus</v-icon>
          {{ t('form.title.create') }}
        </v-btn>
      </template>
    </atn-admin-form>

  </atn-field>


</template>

<script>
import AtnField from "@/plugins/atn/components/field/AtnField";
import AtnButton from "@/plugins/atn/components/admin/AtnButton";
import {VAutocomplete} from 'vuetify/lib'

const _ = require('lodash')

const props = VAutocomplete.options.props
delete props.items;

export default {
  name: "AtnFieldEntityChips",
  components: {AtnButton, AtnField},
  mixins: [AtnField],
  inject: ['dispatcher'],
  props: {
    ...props,
    entity: {
      type: String,
      required: true
    },
    multiple: {
      type: Boolean,
      default() {
        return true
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
      this.data = this.data.filter((data) => {
        return data.id !== item.id
      });
    },
    load() {
      this.admin.client.read({page_size: 50})
        .success((response) => {
          this.items = response.items
        }).run()
    }
  },
  computed: {
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



