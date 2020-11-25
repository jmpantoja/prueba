<script>
import CrudGridAction from "./CrudGridAction";

export default {
    name: "CrudGridActionEdit",
    extends: CrudGridAction,
    props: {
        icon: {
            type: String,
            default: () => "mdi-pencil"
        },
    },
    methods: {
        onClick(item) {
            this.grid.edit(item)
        }
    }
}
</script>

<style scoped>

</style>
