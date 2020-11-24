<template>
    <v-text-field
        :clearable="false"
        v-bind="$props"
        v-on="$listeners"
        type="date"
        v-model="date"
    />
</template>

<script>
import {VTextField} from 'vuetify/lib'

export default {
    name: "input-date",
    extends: VTextField,
    props: {
        value: {}
    },
    computed: {
        date: {
            get() {
                return this.$moment(this.value).format('Y-MM-DD')
            },
            set(value) {
                this.$emit('input', value)
            }
        }
    }
}
</script>

<style scoped>

</style>
