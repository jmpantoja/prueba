<template>
    <v-card class="elevation-3 ma-3">
        <v-data-table
            fixed-header
            height="calc(100vh - 340px)"
            hide-default-footer
            :headers="headers"
            :items="grid.items"
            :loading="grid.loading"
            :options.sync="grid.options"
            :server-items-length="grid.total"
            :page.sync="page"
            @page-count="pageCount = $event"
        >

            <template
                v-for="header in headers "
                :slot="'header.' + header.value"
                v-key="header.value"
            >
                <slot :name="'header.' + header.value" :header="header">
                    {{ header.text }}
                </slot>
            </template>

            <template
                v-for="header in headers"
                :slot="'item.' + header.value"
                v-key="header.value"
                slot-scope="{item}"
            >
                <slot :name="'item.' + header.value" :item="item" :header="header" :value="$_.get(item, header.value)">
                    {{ $_.get(item, header.value) }}
                </slot>
            </template>

        </v-data-table>
        <div v-if="pageCount > 1" class="pa-2 text-center">
            <v-pagination
                v-model="page"
                class="ma-2"
                :length="pageCount"
                total-visible="6"
            />
        </div>
    </v-card>
</template>

<script>

export default {
    name: "DataTable",
    inject: ['grid'],
    props: {
        headers: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            page: 1,
            pageCount: 0,
        }
    }
}
</script>

<style scoped>

</style>
