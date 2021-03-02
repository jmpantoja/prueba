<template>
  <v-pagination
    v-model="grid.page"
    style="margin: auto"
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
