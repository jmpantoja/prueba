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
      :multiple="true"
      :cache-items="true"
      :chips="true"
      :deletable-chips="true"
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

      <template v-slot:selection="{ item }">
        <v-chip close color="info" @click:close="remove(item)">
          {{ itemToString(item) }}
        </v-chip>
      </template>

    </v-autocomplete>
  </atn-field>
</template>

<script>
import AtnFieldEntity from "@/plugins/atn/components/field/AtnFieldEntity";
import {
  getPropertyFromItem,
} from 'vuetify/lib/util/helpers'

export default {
  name: "AtnFieldEntityTags",
  extends: AtnFieldEntity,
  methods: {
    remove(item) {
      this.data = this.data.filter((data) => {
        return data.id !== item.id
      });
    },
    itemToString(item) {
      return  getPropertyFromItem(item, this.itemText)
    },
  }
}
</script>

<style scoped>

</style>
