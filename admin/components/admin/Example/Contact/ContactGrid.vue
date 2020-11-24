<template>
    <div>
        <data-table :headers="headers">
            <template v-slot:item.fullName.lastName="{item}">
                {{ item.fullName.lastName }}, {{ item.fullName.firstName }}
            </template>

            <template v-slot:item.birthDate="{value}">
                {{ $moment(value).format('LL') }}
            </template>

            <template v-slot:item.actions="{item}">
                <data-table-edit :item="item"/>
                <data-table-delete :item="item"/>
<!--                <data-table-action icon="mdi-pencil" :item="item" @click="onEdit"/>-->
            </template>
        </data-table>
    </div>
</template>

<script>
import DataTable from "~/components/crud/DataTable";
import DataTableDelete from "~/components/crud/DataTableDelete";
import DataTableAction from "~/components/crud/DataTableAction";
import DataTableEdit from "~/components/crud/DataTableEdit";


export default {
    name: "ContactGrid",
    components: {DataTableEdit, DataTableDelete, DataTableAction, DataTable},
    inject: ['grid'],
    data() {
        return {
            headers: [
                {
                    text: 'id',
                    value: 'id',
                    width: 100
                },
                {
                    text: 'name',
                    value: 'fullName.lastName',
                    path: 'fullName'
                },
                {
                    text: 'birthdate',
                    value: 'birthDate',
                    width: 'auto'
                },
                {
                    text: 'age',
                    value: 'age',
                    width: 100,
                    align: 'left'
                },
                {
                    value: 'actions',
                    width: 500,
                    align: 'right',
                },
            ]
        }
    },
}
</script>

<style scoped>

</style>
