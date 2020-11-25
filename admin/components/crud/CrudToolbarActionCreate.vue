<script>
import CrudToolbarAction from "./CrudToolbarAction";

export default {
    name: "CrudToolbarActionCreate",
    extends: CrudToolbarAction,
    props: {
        icon: {
            type: String,
            default: () => "mdi-plus"
        },
    },
    methods: {
        onClick(item) {
            this.grid.create(item)
        }
    }
}
</script>

<style scoped>

</style>
