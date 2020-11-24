<template>
    <grid
        :headers="headers"
        :items-per-page="15"
        :actions="actions"
        :toolbar="toolbar"
        :endpoint="endpoint"
    >
        <template v-slot:item.fullName="{value}">
            {{ value.lastName }}, {{ value.firstName }}
        </template>

        <template v-slot:item.birthDate="{value}">
            {{ $moment(value).format('LL') }}
        </template>
    </grid>

</template>

<script>
import Grid from '~/components/grid/Grid'
import ContactForm from "./ContactForm";

export default {
    name: 'ContactList',
    components: {Grid},
    data() {
        return {
            endpoint: '/contacts',
            items: [],
            headers: [
                {
                    text: this.$t('admin.example.contact.grid.headers.fullName'),
                    align: 'start',
                    filterable: true,
                    value: 'fullName'
                },
                {
                    text: this.$t('admin.example.contact.grid.headers.birthDate'),
                    align: 'start',
                    filterable: true,
                    value: 'birthDate'
                },
                {
                    text: this.$t('admin.example.contact.grid.headers.age'),
                    align: 'start',
                    filterable: true,
                    value: 'age'
                },
            ],
            actions: {},
            toolbar: {
                title: this.$t('admin.example.contact.grid.title')
            }
        }
    },

}
</script>
<style scoped>

</style>
