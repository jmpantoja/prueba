<template>
    <crud-form-modal :title="title" :width="800">
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

    </crud-form-modal>

</template>

<script>


import CrudFormModal from "~/components/crud/CrudFormModal";
import InputDate from "~/components/form/InputDate";

export default {
    name: "CrudForm",
    inject: ['form'],
    components: {CrudFormModal, InputDate},
    data() {
        return {
            rules: {
                form: [],
                firstName: [
                    v => !!v || this.$t('rules.required'),
                ],
                lastName: [
                    v => !!v || this.$t('rules.required'),
                ],
            },
        }
    },
    computed: {
        title() {
            if (this.form.mode === 'edit') {
                return this.$t('admin.example.contact.form.title.edit')
            }
            return this.$t('admin.example.contact.form.title.create')
        }
    }
}
</script>

<style scoped>

</style>
