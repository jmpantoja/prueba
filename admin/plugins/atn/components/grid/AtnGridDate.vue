<template>
  <div>
    {{ $d(new Date(value), 'short') }}
  </div>
</template>

<script>

export default {
  name: "AtnGridDate",
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
