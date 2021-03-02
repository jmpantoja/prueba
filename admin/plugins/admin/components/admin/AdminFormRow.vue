<template>
  <v-row>
    <v-col v-for="(col, colIndex) in row" :key="colIndex" v-bind="col.props">

      <template v-for="(field, name) in col.fields">
        <v-wrapper :key="name" :field="field" v-model="item[name]" @update:error="onInput(name, $event)"/>
      </template>
    </v-col>
  </v-row>
</template>

<script>
import VWrapper from "~/plugins/admin/components/form/VWrapper";

export default {
  name: "AdminFormRow",
  components: {VWrapper},
  props: {
    row: {
      type: Array,
      required: true
    },
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      errorBag: {},
      inValid: false
    }
  },
  methods: {
    onInput(key, error) {
      this.$set(this.errorBag, key, error)
      const hasErrors = Object.values(this.errorBag).includes(true)

      if (hasErrors !== this.inValid) {
        this.inValid = hasErrors
        this.$emit('update:error', hasErrors)
      }
    }
  }
}
</script>

<style scoped>

</style>
