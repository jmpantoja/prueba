<template>
    <v-toolbar class="ma-3 toolbar" flat>
        <v-toolbar-title v-if="title" class="text-h3 font-weight-thin">
            {{ title }}
        </v-toolbar-title>
        <v-spacer/>
        <slot>

        </slot>

        <!--        <template v-for="(action, key) in _toolbar.actions" v-key="key">-->
        <!--            <v-menu v-if="!$utils.isEmpty(action.items)" :key="key" offset-y>-->
        <!--                <template v-slot:activator="{ on, attrs }">-->
        <!--                    <v-btn icon color="primary" v-bind="attrs" v-on="on">-->
        <!--                        <v-icon>{{ action.icon }}</v-icon>-->
        <!--                    </v-btn>-->
        <!--                </template>-->
        <!--                <v-list>-->
        <!--                    <v-list-item-->
        <!--                        v-for="(item, index) in $utils.filter(action.items)"-->
        <!--                        :key="index"-->
        <!--                        @click="exec(action.callback, item, action)"-->
        <!--                    >-->
        <!--                        <v-list-item-action>-->
        <!--                            <v-icon>{{ item.icon }}</v-icon>-->
        <!--                        </v-list-item-action>-->
        <!--                        <v-list-item-content>-->
        <!--                            <span>{{ item.text }}</span>-->
        <!--                        </v-list-item-content>-->
        <!--                    </v-list-item>-->
        <!--                </v-list>-->
        <!--            </v-menu>-->

        <!--            <v-btn v-else-if="action" :key="key" icon color="primary" @click="exec(action.callback, action)">-->
        <!--                <v-icon>{{ action.icon }}</v-icon>-->
        <!--            </v-btn>-->
        <!--        </template>-->
    </v-toolbar>

</template>

<script>
export default {
    name: "CrudToolbar",
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
