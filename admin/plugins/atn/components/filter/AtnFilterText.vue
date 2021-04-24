<template>
  <div>
    <v-label color="primary">{{ label }}</v-label>
    <v-row class="mt-0">
      <v-col cols="4" class="pt-0">
        <v-select v-bind="$props"
                  :items="types"
                  :label="null"
                  item-value="value"
                  item-text="text"
                  @input="$emit('input', data)"
                  v-model="data.type"
        />
      </v-col>
      <v-col cols="8" class="pt-0">
        <v-text-field v-bind="$props"
                      :label="null"
                      @input="$emit('input', data)"
                      v-model="data.value"
        />
      </v-col>

    </v-row>
  </div>
</template>

<script>
import VInput from 'vuetify/lib/components/VInput/VInput.js';

export default {
  name: "AtnFilterText",
  extends: VInput,
  props: {
    value: {
      default() {
        return {}
      }
    }
  },
  data() {
    return {
      type: 'contains',
      text: null,
      types: [
        {value: 'equals', text: this.$t('filter.equals')},
        {value: 'contains', text: this.$t('filter.contains')},
        {value: 'begins', text: this.$t('filter.begins')},
        {value: 'ends', text: this.$t('filter.ends')},
      ]
    };
  },
  computed: {
    data() {
      const type = this.value.type || 'contains'
      const value = typeof this.value === 'object' ? this.value.value : this.value

      return {
        type,
        value: value || ''
      }
    }
  },
  created() {
    //ES NECESARIO
    //para que el formulario vea reflejado los valores de type y de value
    this.$emit('input', this.data)
  }
}
</script>

<style scoped>

</style>
