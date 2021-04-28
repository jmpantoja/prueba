<template>
  <div>
    {{ value.name.name }} {{ value.name.lastName }}
  </div>
</template>

<script>

export default {
  name: 'AtnGridMovieDirector',
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
