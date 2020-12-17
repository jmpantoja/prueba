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
                  v-model="type"
        />
      </v-col>
      <v-col cols="8" class="pt-0">
        <v-text-field v-bind="$props"
                      :label="null"
                      v-model="text"
        />
      </v-col>

    </v-row>
  </div>
</template>

<script>
import VInput from 'vuetify/lib/components/VInput/VInput.js';

export default {
  name: "FilterText",
  extends: VInput,
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
  watch: {
    type(value) {
      this.change()
    },
    text(value) {
      this.change()
    }
  },
  methods: {
    default(){
      this.type = 'contains'
      this.text = null
      this.change()
    },
    change() {
      this.$emit('input', {
        type: this.type,
        value: this.text
      })
    }
  }
}
</script>

<style scoped>

</style>
