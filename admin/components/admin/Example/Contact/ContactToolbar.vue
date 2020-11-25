<template>
    <crud-toolbar :title="title">
        <crud-toolbar-action-create/>
    </crud-toolbar>

</template>

<script>
import CrudToolbar from "../../../crud/CrudToolbar";
import CrudToolbarActionCreate from "../../../crud/CrudToolbarActionCreate";

export default {
    name: "ContactToolbar",
    components: {CrudToolbarActionCreate, CrudToolbar},
    data() {
        return {
            title: 'Titulo'
        }
    }
}
</script>

<style scoped lang="scss">
.toolbar {
    background-color: transparent !important;
}
</style>
