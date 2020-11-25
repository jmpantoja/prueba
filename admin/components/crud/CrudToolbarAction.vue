<template>
    <v-btn color="primary" icon @click="onClick(item)">
        <v-icon v-if="icon">{{ icon }}</v-icon>
    </v-btn>

</template>

<script>
export default {
    name: "CrudToolbarAction",
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
            alert('hola');
        }
    }
}
</script>

<style scoped>

</style>
