<template>

    <v-btn icon @click="onClick(item)">
        <v-dialog v-model="modal" max-width="400">
            <v-card>
                <v-card-title class="headline">
                    {{ $t('modal.delete.title') }}
                </v-card-title>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="modal = false">
                        {{ $t('modal.no') }}
                    </v-btn>

                    <v-btn text color="danger" @click="onDelete(item)">
                        {{ $t('modal.yes') }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-icon v-if="icon" small>{{ icon }}</v-icon>
    </v-btn>
</template>

<script>
import CrudGridAction from "./CrudGridAction";

export default {
    name: "CrudGridActionDelete",
    extends: CrudGridAction,
    props: {
        icon: {
            type: String,
            default: () => "mdi-delete"
        },
    },
    data() {
        return {
            modal: false
        }
    },
    methods: {
        onClick() {
            this.modal = true
        },
        async onDelete(item) {

            await this.grid.delete(item)
            this.modal = false

        }
    }
}
</script>

<style scoped>

</style>
