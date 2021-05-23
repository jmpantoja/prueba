<template>
  <atn-field :label="label">

    <draggable tag="ul" :list="data" class="list-group" handle=".handle">
      <li v-for="(item, key) in data" :key="key">

        <v-icon class="mr-5 mb-6 handle">mdi-reorder-horizontal</v-icon>

        <atn-field-single
          :label="null"
          v-bind="$props"
          v-on="listeners"
          v-model="data[key]"
        />
        <v-btn icon @click="add" class="ml-5 mb-4 error--text">
          <v-icon>mdi-delete-outline</v-icon>
        </v-btn>
      </li>
    </draggable>
    <v-btn @click="add" color="info" class="mt-2" elevation="0">
      <v-icon left>mdi-plus</v-icon>
      {{ t('form.title.create') }}
    </v-btn>
  </atn-field>
</template>

<script>
import draggable from "vuedraggable";
import AtnFieldSingle from "@/plugins/atn/components/form/AtnFieldSingle";
import dataInput from "@/plugins/atn/components/form/mixins/dataInput";
import AtnField from "@/plugins/atn/components/form/AtnField";

export default {
  name: "AtnFieldMultiple",
  components: {AtnField, AtnFieldSingle, draggable},
  mixins: [dataInput],
  inject: ['namespace'],
  props: {
    label: String,
    type: String,
    props: Object,
    value: Array | Object
  },

  data() {
    return {
      list: [
        {name: "John", text: "", id: 0},
        {name: "Joao", text: "", id: 1},
        {name: "Jean", text: "", id: 2}
      ],
    }
  },

  computed: {

    listeners() {
      const listeners = {
        ...this.$listeners
      }
      delete listeners['input']
      return listeners
    }
  },

  methods: {
    add() {
      this.data.push(null)
    }
  }

}
</script>

<style scoped lang="scss">
ul {

  width: 100%;
  padding: 0;

  li {
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: end;
    padding: 0;

    > div {
      flex: 1;
    }
  }
}
</style>
