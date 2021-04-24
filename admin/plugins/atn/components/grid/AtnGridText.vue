<template>
  <div>
    {{ value }}
  </div>
</template>

<script>

export default {
  name: "AtnGridText",
  props: {
    item: {
      type: Object,
      required: true
    },
    value: {
      required: true
    },
    name: {
      type: String,
      required: true
    }
  }

}
</script>

<style scoped>

</style>
