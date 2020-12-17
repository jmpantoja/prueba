<template>
  <crud-grid :grid="grid">
    <template v-slot:filters="{filters}">
      <filter-text label="Last Name" v-model="filters['fullName.lastName']"/>
    </template>

    <template v-slot:item.fullName.lastName="{item}">
      {{ item.fullName.lastName }}, {{ item.fullName.firstName }}
    </template>

    <template v-slot:item.birthDate="{value}">
      {{ $moment(value).format('LL') }}
    </template>

  </crud-grid>
</template>

<script lang="ts">
import {Grid} from "~/plugins/admin/types";

export default {
  name: 'ContactGrid',
  props: {
    grid: {
      type: Grid
    }
  }
}
</script>
