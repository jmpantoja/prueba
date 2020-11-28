<template>
    <v-card class="crud-grid elevation-3 ma-3 overflow-hidden">

        <v-navigation-drawer
            class="menu"
            mini-variant
            permanent
            absolute
        >
            <v-btn @click="grid.toggleFilters()" icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn @click="cleanFilters" icon>
                <v-icon>mdi-restart</v-icon>
            </v-btn>

        </v-navigation-drawer>

        <crud-filter-panel ref="filter_panel"/>

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

import CrudFilterPanel from "./CrudFilterPanel";

export default {
    name: "CrudGrid",
    components: {CrudFilterPanel},
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
    },
    methods: {
        cleanFilters() {
            this.$refs.filter_panel.onReset()
            this.grid.filtersPanel = false
        },

        hola() {

            const name = this.$route.name;
            // const url = this.$router.resolve({
            //     name: name,
            //     params: {
            //         koko: 'kaka'
            //     }
            // })
            //
            // console.log(url)

            const kkk = this.$router.currentRoute.name
            console.log(kkk)

            this.$router.push({
                name: name,
                query: {
                    koko: 'kakak'
                }
            })
        }
    }
}
</script>

<style lang="scss">
.crud-grid {
    .menu {
        text-align: center;
        padding-top: 1em;
    }

    .v-data-table {
        margin-left: 56px;
    }

    .crud-grid-panel {
        margin-left: 56px;
        box-shadow: none;
    }

    .v-overlay {
        margin-left: 56px;
        box-shadow: none;
    }
}

</style>
