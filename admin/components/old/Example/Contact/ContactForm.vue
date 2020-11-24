<template>
    <form-card :title="title">
        <v-row>
            <v-col
                cols="12"
                sm="6"
                md="6"
            >
                <v-text-field
                    :label="$t('admin.example.contact.form.labels.firstName')"
                    required
                    v-model="data.fullName.firstName"
                    :rules="rules.firstName"
                ></v-text-field>
            </v-col>
            <v-col
                cols="12"
                sm="6"
                md="6"
            >
                <v-text-field
                    :label="$t('admin.example.contact.form.labels.lastName')"
                    hint="example of helper text only on focus"
                    v-model="data.fullName.lastName"
                    :rules="rules.lastName"
                ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
                <v-text-field
                    :label="$t('admin.example.contact.form.labels.birthDate')"
                    type="date"
                    v-model="$moment(data.birthDate).format('Y-MM-DD')"
                    required
                ></v-text-field>

            </v-col>
        </v-row>
    </form-card>

</template>

<script>
import FormCard from "~/components/grid/FormCard";

export default {
    name: "ContactForm",
    components: {FormCard},

    props: {
        item: {
            type: Object,
            required: true
        },
    },

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
            }
        }
    },

    computed: {
        title() {
            if (this.item.id) {
                return this.$t('admin.example.contact.form.title.edit')
            }
            return this.$t('admin.example.contact.form.title.create')
        },
        data() {
            const defaults = {
                fullName: {},
                birthDate: null
            };
            return _.merge(defaults, this.item)
        }
    }
}
</script>

<style scoped>

</style>
