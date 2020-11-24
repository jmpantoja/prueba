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
                        <input-date
                            :label="$t('admin.example.contact.form.labels.birthDate')"
                            v-model="item.birthDate"
                        />
                    </v-col>
                </v-row>
            </v-container>
        </template>

    </form-dialog>

</template>

<script>

import FormDialog from "../../../crud/FormDialog";
import InputDate from "../../../form/input-date";

export default {
    name: "ContactForm",
    components: {InputDate, FormDialog},
    data() {
        return {
            borrame: 'hola',
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
