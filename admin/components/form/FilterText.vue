<template>
    <div>
        <v-label color="primary">{{ label }}</v-label>
        <v-row class="mt-0">
            <v-col cols="4" class="pt-0">
                <v-select v-bind="_cprops"
                          :items="types"
                          :label="null"
                          item-value="value"
                          item-text="text"
                          v-model="value.key"/>
            </v-col>
            <v-col cols="8" class="pt-0">
                <v-text-field v-bind="_cprops"
                              label=""
                              v-model="value.value"/>
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
            types: [
                {value: 'equals', text: this.$t('filter.equals')},
                {value: 'contains', text: this.$t('filter.contains')},
                {value: 'begins', text: this.$t('filter.begins')},
                {value: 'ends', text: this.$t('filter.ends')},
            ]
        };
    },
    computed: {
        _cprops() {
            return {
                ...this.$props,
            }
        },
    }
}
</script>

<style scoped>

</style>
