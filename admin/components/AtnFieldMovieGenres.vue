<template>
  <atn-field v-bind="$props" v-on="$listeners">

    <v-autocomplete
      :items="genres"
      :cache-items="true"
      v-model="data"
      chips
      deletable-chips
      multiple
      clearable
      item-text="name"
      item-color="primary"
      return-object
      hide-details
    >
      <template v-slot:selection="{ item }">
        <v-chip close color="info" @click:close="remove(item)">
          {{ item.name }}
        </v-chip>
      </template>
    </v-autocomplete>

    <atn-admin-form :form="admin.form" />
    <v-btn text color="primary" small @click="create">
      <v-icon left>
        mdi-plus
      </v-icon>
      Nuevo Genre
    </v-btn>

  </atn-field>


</template>

<script>
import AtnField from "~/plugins/atn/components/AtnField";

const _ = require('lodash')

export default {
  name: "AtnFieldMovieGenres",
  components: {AtnField},
  mixins: [AtnField],
  // provide() {
  //   return {
  //     trans: (key) => {
  //       return this.admin.i18n.translate(key)
  //     },
  //     manager: this.admin.actionManager
  //   }
  // },
  data() {
    return {
      genres: [],
      admin: this.$adminManager.byName('genres')
    }
  },
  methods: {
    remove(item) {
      this.data = this.data.filter((data) => {
        return data.id !== item.id
      });
    },
    create() {
      this.admin.form.show()
    },
  },
  mounted() {

    this.admin.client.read()
      .success((response) => {
        this.genres = response.items
      }).run()
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



