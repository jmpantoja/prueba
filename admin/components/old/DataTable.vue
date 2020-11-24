<template>
    <v-card class="elevation-3 ma-3">
        <v-data-table
            fixed-header
            height="calc(100vh - 340px)"
            hide-default-footer
            :loading="loading"
            :headers="_headers"
            :items="items"
            :options.sync="options"
            :items-per-page="itemsPerPage"
            :server-items-length="total"
            :page.sync="page"
            @page-count="pageCount = $event"
        >
            <template
                v-for="header in _headers "
                :slot="'header.' + header.value"
                v-key="header.value"
            >
                <slot :name="'header.' + header.value" :header="header">
                    {{ header.text }}
                </slot>
            </template>

            <template
                v-for="header in _headers"
                :slot="'item.' + header.value"
                v-key="header.value"
                slot-scope="{item}"
            >
                <slot :name="'item.' + header.value" :item="item" :header="header" :value="item[header.value]">
                    {{ item[header.value] }}
                </slot>
            </template>

            <template :slot="'item.__actions'" slot-scope="{item}">
                <slot :name="'item.__actions'" :item="item">



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
    props: {
        headers: {
            type: Array,
            default: () => []
        },
        actions: {
            type: Object,
            default: () => {
            }
        },
        loader: {
            type: Function
        },
        items: {
            type: Array,
            default: () => []
        },
        itemsPerPage: {
            type: Number,
            default: () => 10
        },
        loading: {
            type: Boolean,
            default: () => false
        },
        total: {
            type: Number,
            default: () => 0
        },
    },
    computed: {
        _headers() {
            if (this.$utils.isEmpty(this.actions)) {
                return this.headers
            }
            return [].concat(this.headers, [{
                value: '__actions',
                align: 'right',
                sortable: false
            }])
        },
    },
    data() {
        return {
            page: 1,
            pageCount: 0,
            options: {}
        }
    },

    watch: {
        options: {
            handler(options) {
                this.$parent.refresh(options)
            },
            deep: true
        }
    }
}
</script>

<style scoped>

</style>
