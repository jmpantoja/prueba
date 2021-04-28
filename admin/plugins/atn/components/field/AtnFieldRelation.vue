<template>
  <atn-field v-on="$listeners">
    <v-autocomplete
      :items="items"
      :multiple="multiple"
      :cache-items="true"
      :clearable="false"
      v-model="data"
      chips
      deletable-chips
      return-object
      hide-details
      v-bind="$props"
    >

      <template v-slot:prepend-item>
        <atn-admin-form :form="admin.form">
          <template v-slot:activator="{ on, attrs }">
            <v-btn plain color="primary" v-bind="attrs" v-on="on">
              <v-icon left>mdi-plus</v-icon>
              {{ t('form.title.create') }}
            </v-btn>
          </template>
        </atn-admin-form>
        <v-divider/>
      </template>

      <template v-slot:selection="{ item }">
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
    type: {
      type: String,
      required: true,
      validator: (value) => {
        return ['labels', 'one'].includes(value)
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
      return ['labels'].includes(this.type)
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



