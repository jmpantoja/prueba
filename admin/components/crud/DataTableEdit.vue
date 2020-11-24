<template>

    <v-btn icon @click="onClick(item)">
        <v-icon v-if="icon" small>{{ icon }}</v-icon>
    </v-btn>
</template>

<script>
import DataTableAction from "./DataTableAction";

export default {
    name: "DataTableEdit",
    extends: DataTableAction,
    props: {
        icon: {
            type: String,
            default: () => "mdi-pencil"
        },
    },
    methods: {
        onClick(item) {
            this.grid.edit(item)
        }
    }
}
</script>

<style scoped>

</style>
