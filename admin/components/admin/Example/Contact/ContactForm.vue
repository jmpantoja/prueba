<template>


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


</template>

<script>
import DialogForm from "../../../grid/DialogForm";

export default {
    name: "ContactForm",
    components: {DialogForm},
    props: {
        active: {
            type: Boolean,
            default: () => false
        },
        item: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            default: {
                fullName: {},
                birthDate: null
            },
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
        data() {
            return _.merge(this.default, this.item)
        }
    }
}
</script>

<style scoped>

</style>
