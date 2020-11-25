<template>
    <div>
        <crud-grid :headers="headers">
            <template v-slot:item.fullName.lastName="{item}">
                {{ item.fullName.lastName }}, {{ item.fullName.firstName }}
            </template>

            <template v-slot:item.birthDate="{value}">
                {{ $moment(value).format('LL') }}
            </template>

            <template v-slot:item.actions="{item}">
                <crud-grid-action-edit :item="item"/>
                <crud-grid-action-delete :item="item"/>
            </template>
        </crud-grid>
    </div>
</template>

<script>
import CrudGrid from "~/components/crud/CrudGrid";
import CrudGridActionDelete from "~/components/crud/CrudGridActionDelete";
import CrudGridActionEdit from "~/components/crud/CrudGridActionEdit";


export default {
    name: "ContactGrid",
    components: {CrudGrid, CrudGridActionDelete, CrudGridActionEdit},
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
