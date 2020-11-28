<template>
    <v-navigation-drawer class="crud-grid-panel" v-model="grid.filtersPanel" width="500px" absolute temporary>
        <v-form ref="form" style="height: 100%" lazy-validation onSubmit="return false;"
                @keyup.enter.native="onFilter">
            <v-card height="100%" class="d-flex flex-column">
                <v-card-text>
                    <filter-text ref="uno" label="name" v-model="filters['fullName.lastName']"/>
                </v-card-text>
                <v-spacer></v-spacer>
                <v-card-actions>
                    <v-spacer/>
                    <slot name="action_reset" :filters="filters">
                        <v-btn color="primary" text @click="onReset()">
                            {{ $t('form.reset') }}
                        </v-btn>
                    </slot>
                    <slot name="action_filter" :filters="filters">
                        <v-btn color="primary" text @click="onFilter()">
                            {{ $t('form.filter') }}
                        </v-btn>
                    </slot>
                </v-card-actions>
            </v-card>
        </v-form>

    </v-navigation-drawer>
</template>
<script>
import FilterText from "../form/FilterText"

export default {
    name: 'CrudFilterPanel',
    inject: ['grid'],
    components: {FilterText},
    data() {
        return {
            drawer: false,
            filters: this.grid.defaultFilters
        }
    },
    methods: {
        onReset() {
            this.filters = this.grid.defaultFilters
            this.grid.filterBy(this.filters)
        },
        onFilter() {
            this.grid.filterBy(this.filters)
            this.grid.filtersPanel = false
        }
    }
}
</script>
