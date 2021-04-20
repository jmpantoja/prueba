<template>
  <atn-field v-bind="$props" v-on="$listeners">

    <v-autocomplete
      :items="items"
      :cache-items="true"
      v-model="data"
      chips
      deletable-chips
      multiple
      clearable
      item-text="name"
      return-object
      hide-details
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
          Nuevo Genre
        </v-btn>
      </template>
    </atn-admin-form>

  </atn-field>


</template>

<script>
import AtnField from "~/plugins/atn/components/AtnField";
import AtnButton from "@/plugins/atn/components/AtnButton";

const _ = require('lodash')

export default {
  name: "AtnFieldMovieGenres",
  components: {AtnButton, AtnField},
  mixins: [AtnField],
  inject: ['dispatcher'],
  data() {
    return {
      items: [],
      admin: this.$adminManager.byName('genres')
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
  mounted() {
    this.dispatcher.on('genres.post.save', () => {
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



