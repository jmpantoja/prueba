<template>
  <crud-panel :crud="crud">
    <template v-slot="{filters}">
      <filter-text label="Last Name" v-model="filters['fullName.lastName']"/>
    </template>
  </crud-panel>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";

export default {
  name: 'ContactPanel',
  props: {
    crud: {
      type: Crud,
      required: true
    }
  }
}
</script>
