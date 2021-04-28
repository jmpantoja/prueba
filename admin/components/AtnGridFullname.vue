<template>
  <div>
    {{ value.lastName }}, {{ value.name }}
  </div>
</template>

<script>

export default {
  name: 'AtnGridFullname',
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
};
</script>

<style lang="scss">

</style>
