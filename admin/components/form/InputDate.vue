<template>
    <v-text-field
        v-bind="_cprops"
        v-on="$listeners"
        v-model="date"
        :rules="valid_date"
        :validate-on-blur="true"
    />
</template>

<script>
import {VTextField} from 'vuetify/lib'

export default {
    name: "InputDate",
    extends: VTextField,
    props: {
        value: {},
    },
    data() {
        return {
            valid_date: [
                v => {
                    return this.$moment(v, 'YYYY-MM-DD', true)._isValid || this.$t('rules.date')
                }
            ]
        }
    },
    computed: {
        date: {
            get() {
                return this.$moment(this.value).format('Y-MM-DD')
            },
            set(value) {
                this.$emit('input', value)
            }
        },
        _cprops() {
            return {
                clearable: true,
                ...this.$props,
                type: "date",
            }
        }
    }
}
</script>

<style scoped>

</style>
