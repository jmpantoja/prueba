<template>
  <v-toolbar class="mx-2 toolbar crud-toolbar" flat>
    <v-toolbar-title class="text-h3 font-weight-thin">
      {{ title }}
    </v-toolbar-title>
    <v-spacer/>

    <v-btn color="primary" icon>
      <v-icon large>mdi-download</v-icon>
    </v-btn>
  </v-toolbar>
</template>

<script>
export default {
  name: 'AdminToolbar',
  props: {
    title: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.v-toolbar.v-sheet.crud-toolbar {
  background-color: transparent;
}
</style>
