<template>
    <v-btn icon @click="onClick(item)">
        <v-icon v-if="icon" small>{{ icon }}</v-icon>
    </v-btn>
</template>

<script>
export default {
    name: "DataTableAction",
    inject: ['grid'],
    props: {
        item: {
            type: Object,
            default: () => ({})
        },
        icon: {
            type: String,
            default: () => ""
        },
    },
    methods: {
        onClick() {
            this.$emit('click', this.item)
        }
    }
}
</script>

<style scoped>

</style>
