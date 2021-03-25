<template>
  <div id="app">
    <h1>dashboard</h1>
  </div>

</template>

<script>
export default {
  data() {
    return {
      selectedItem: 0,
    }
  },
  methods: {
    click(selector, event) {
      this.$vuetify.goTo(selector, {
        container: '.container'
      })
    }
  }
}
</script>


<style scoped lang="scss">
::v-deep .box {
  background-color: yellow;
  height: 500px;
  margin: 2em;
}

::v-deep .v-tabs {
  display: block;
}

::v-deep .v-tab {
  padding: 0 !important;
  text-align: left !important;
}
</style>
