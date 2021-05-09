<template>
  <atn-field-multiple v-if="multiple" v-bind="$props" v-on="$listeners"/>
  <atn-field-single v-else v-bind="$props" v-on="$listeners"/>
</template>

<script>
import {camelCase, startCase} from 'lodash';
import AtnField from "@/plugins/atn/components/form/AtnField";
import dataInput from "@/plugins/atn/components/form/mixins/dataInput";
import AtnFieldMultiple from "@/plugins/atn/components/form/AtnFieldMultiple";
import AtnFieldSingle from "@/plugins/atn/components/form/AtnFieldSingle";

const pascalCase = (str) => {
  return startCase(camelCase(str)).replace(/ /g, '');
}


export default {
  name: "AtnFieldWrapper",
  components: {AtnFieldSingle, AtnFieldMultiple, AtnField},
  mixins: [dataInput],

  props: {
    multiple: Boolean,
    label: String,
    type: String,
    props: Object
  }
}
</script>

<style scoped>

</style>
