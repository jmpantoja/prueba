<template>
  <v-tabs v-model="tab">

    <v-tab v-for="(tab, tabIndex) in layout.tabs"
           :key="tabIndex"
           :class="{'error--text': tabError[tabIndex]}">
      {{ tab.label }}
    </v-tab>

    <v-tabs-items ref="tabItems" v-model="tab">
      <v-tab-item
        eager
        v-for="(tab, tabIndex) in layout.tabs"
        :key="tabIndex">

        <admin-form-row
          v-for="(row, index) in tab.rows"
          @update:error="onInput(tabIndex, $event)"
          :key="index"
          :row="row"
          :item="item"
        />

      </v-tab-item>
    </v-tabs-items>
  </v-tabs>


</template>

<script>

import AdminFormRow from "~/plugins/admin/components/admin/AdminFormRow";

export default {
  name: "AdminFormTabs",
  components: {AdminFormRow},
  props: {
    layout: {
      type: Object
    },
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      tab: 0,
      tabError: {}
    }
  },
  methods: {
    onInput(tabIndex, error) {
      this.$set(this.tabError, tabIndex, error)
    }
  }
}
</script>

<style scoped>

</style>
