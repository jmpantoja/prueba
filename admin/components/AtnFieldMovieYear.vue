<template>
  <atn-field v-bind="$props" v-on="$listeners">
    <v-autocomplete :items="years" v-model="data"/>
  </atn-field>
</template>

<script>
import AtnField from "~/plugins/atn/components/AtnField";

const _ = require('lodash')

export default {
  name: "AtnFieldMovieYear",
  components: {AtnField},
  mixins: [AtnField],

  computed: {
    years() {
      const today = new Date().getFullYear()
      return _.range(1900, today + 10)
    }
  }
}

</script>

<style scoped>

</style>



