<template>
  <div>
    <component
      :is="component"
      v-if="isAtn"
      v-model="data"
      v-bind="props"
      v-on="$listeners"
      :label="label"
    />
    <atn-field v-else :label="label" @focus="$emit('focus', $event)">
      <component
        :is="component"
        v-model="data"
        v-bind="props"
        v-on="$listeners"/>
    </atn-field>
  </div>
</template>

<script>
import Vue from 'vue';

import {camelCase, startCase} from 'lodash';
import AtnField from "@/plugins/atn/components/form/AtnField";
import dataInput from "@/plugins/atn/components/form/mixins/dataInput";

const pascalCase = (str) => {
  return startCase(camelCase(str)).replace(/ /g, '');
}

export default {
  name: "AtnFieldSingle",
  components: {AtnField},
  mixins: [dataInput],

  props: {
    label: String,
    type: String,
    props: Object
  },
  computed: {
    component() {
      const type = pascalCase(this.type)
     // console.log(type)
      return Vue.component(type);
    },
    isAtn() {

      return this.component.options.atn || false
    }
  }
}
</script>

<style scoped>

</style>
