<template>
  <div>
    {{ value }}  <i>({{item.year}})</i>
  </div>
</template>

<script>

export default {
  name: 'AtnGridMovieTitle',
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
