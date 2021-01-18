<template>
  <v-snackbar
    timeout="3000"
    v-model="toast.opened"
    absolute
    right
    top
    :color="toast.color"
  >
    <h3 v-if="toast.title">
      {{ $t(toast.title) }}
    </h3>
    <p class="mt-4">{{ $t(toast.message) }}</p>

    <template v-slot:action="{ attrs }">
      <v-btn
        icon
        v-bind="attrs"
        @click=""
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </template>

  </v-snackbar>
</template>

<script lang="ts">
import {Crud} from "~/plugins/admin/types";

export default {
  name: 'CrudPanel',
  props: {
    crud: {
      type: Crud,
      required: true
    }
  },
  setup(props: { crud: Crud }) {
    return {
      toast: props.crud.toast,

    }
  }
}

</script>

<style lang="scss">

</style>
