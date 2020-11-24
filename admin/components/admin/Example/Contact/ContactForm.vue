<template>
    <form-dialog :width="800">
        <template v-slot:form="{item}">
            <v-container>
                <v-row>
                    <v-col cols="6">
                        <v-text-field
                            :label="$t('admin.example.contact.form.labels.firstName')"
                            required
                            v-model="item.fullName.firstName"
                            :rules="rules.firstName"

                        />
                    </v-col>

                    <v-col cols="6">
                        <v-text-field
                            :label="$t('admin.example.contact.form.labels.lastName')"
                            required
                            v-model="item.fullName.lastName"
                            :rules="rules.lastName"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="6">

                        <h1 class="red">hacer un componente con esto / datepicker</h1>
                        <v-text-field
                            type="date"
                            :label="$t('admin.example.contact.form.labels.birthDate')"
                            required
                            :value="$moment(item.birthDate).format('Y-MM-DD')"
                            @input="item.birthDate = $event"
                        />

                    </v-col>
                </v-row>
            </v-container>
        </template>

    </form-dialog>

</template>

<script>

import FormDialog from "../../../crud/FormDialog";

export default {
    name: "ContactForm",
    components: {FormDialog},
    data() {
        return {
            rules: {
                form: [],
                firstName: [
                    v => !!v || this.$t('required'),
                ],
                lastName: [
                    v => !!v || this.$t('required'),
                ],
            },
        }
    }
}
</script>

<style scoped>

</style>
