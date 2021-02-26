<template>
  <crud-grid :crud="crud" :headers="headers" :actions="actions">
    <template v-slot:item.fullName.lastName="{item}">
      {{ item.fullName.lastName }}, {{ item.fullName.firstName }}
    </template>

    <template v-slot:item.birthDate="{value}">
      {{ $moment(value).format('LL') }}
    </template>

  </crud-grid>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";

export default {
  name: 'ContactGrid',
  props: {
    crud: {
      type: Crud,
      required: true
    }
  },
  setup() {
    return {
      headers: [
        {text: 'idx', value: 'id', sortable: false},
        {text: 'name', value: 'fullName.lastName', width: 'max-content'},
        {text: 'birthDate', value: 'birthDate', width: 'min-content'},
        {text: 'age', value: 'age', sortable: false}
      ],
      actions: {
        'xxx' : {
          icon: 'mdi-delta',
          action: ()=>{
            alert('hola')
          }
        }
      }
    }
  }
}
</script>
