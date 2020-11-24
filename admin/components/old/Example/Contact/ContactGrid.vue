<script>
import Grid from "../../../crud/Grid";

export default {
    name: "ContactGrid",
    components: {Grid},
    extends: Grid,
    data() {
        return {
            headers: [
                {
                    text: 'id',
                    align: 'start',
                    filterable: true,
                    value: 'id'
                },
                {
                    text: this.$t('admin.example.contact.grid.headers.fullName'),
                    align: 'start',
                    filterable: true,
                    value: 'fullName.lastName'
                },
                {
                    text: this.$t('admin.example.contact.grid.headers.birthDate'),
                    align: 'start',
                    filterable: true,
                    value: 'birthDate'
                },
                {
                    text: this.$t('admin.example.contact.grid.headers.age'),
                    align: 'start',
                    filterable: true,
                    value: 'age'
                },
            ],
            actions: {
                edit: {
                    name: 'edit',
                    icon: 'mdi-pencil',
                    callback: this.onEdit
                },
            }
        }
    },
    methods: {
        normalize(item) {
            return {
                'fullName.lastName': `${item.fullName.lastName}, ${item.fullName.firstName}`,
                birthDate: this.$moment(item.birthDate).format('LL')
            }
        }
    }

}
</script>

<style scoped>

</style>
