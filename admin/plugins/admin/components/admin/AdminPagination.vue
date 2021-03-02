<template>
  <v-pagination
    v-model="grid.page"
    :length="grid.pageCount"
    :total-visible="7"
  />
</template>

<script>
import {Grid} from "~/plugins/admin/src/admin";

export default {
  name: 'AdminPagination',
  props: {
    grid: {
      type: Grid,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
nav {
  margin: -1em auto 1em auto;
}
</style>
