<template>
  <div>
    esto es el dashboard
    <component :is="hola" />

  </div>
</template>

<script>
export default {
  name: "Dashboard",
  layout: 'dashboard',
  props: {
    hola: {
      type: Object
    }
  }
}
</script>

<style scoped>

</style>
