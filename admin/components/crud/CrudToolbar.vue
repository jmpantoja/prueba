<template>
    <v-toolbar class="ma-3 toolbar" flat>
        <v-toolbar-title v-if="title" class="text-h3 font-weight-thin">
            {{ title }}
        </v-toolbar-title>

        <v-spacer/>
        <slot></slot>
    </v-toolbar>

</template>

<script>
export default {
    name: "CrudToolbar",
    inject:['grid'],
    props: {
        title: {
            type: String,
            required: false
        }
    }
}
</script>

<style scoped>

</style>
