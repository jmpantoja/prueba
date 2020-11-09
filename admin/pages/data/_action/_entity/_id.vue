<template>
  <v-container>
    <component v-bind:is="admin.form"/>
  </v-container>
</template>

<script>
export default {
  validate({ params }) {
    const action = params.action ?? null;
    const id = params.id ?? null;

    return ['edit'].includes(action) && id !== null
  }
}
</script>
