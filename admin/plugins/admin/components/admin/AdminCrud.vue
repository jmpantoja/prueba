<template>
  <div>
    <admin-flash :flash="admin.flash"/>
    <admin-dialog :dialog="admin.dialog"/>
    <admin-dialog-form :form="admin.form"/>
    <admin-toolbar :toolbar="admin.toolbar"/>
    <v-card class="crud-grid elevation-3 ma-3 overflow-hidden">
      <v-card-text>
        <admin-filters :grid="admin.grid" :filters="admin.filters"/>
        <admin-grid :grid="admin.grid"/>
      </v-card-text>

      <v-card-actions>
        <admin-pagination :grid="admin.grid"/>
      </v-card-actions>

    </v-card>
  </div>
</template>

<script>
import {Admin} from "~/plugins/admin/src/admin";
import AdminGrid from "~/plugins/admin/components/admin/AdminGrid.vue";
import AdminToolbar from "~/plugins/admin/components/admin/AdminToolbar.vue";
import AdminPagination from "~/plugins/admin/components/admin/AdminPagination.vue";
import AdminFilters from "~/plugins/admin/components/admin/AdminFilters.vue";
import AdminForm from "~/plugins/admin/components/admin/AdminDialogForm.vue";
import AdminDialogForm from "~/plugins/admin/components/admin/AdminDialogForm.vue";
import AdminDialog from "./AdminDialog";
import AdminFlash from "./AdminFlash";

export default {
  name: "AdminCrud",
  components: {
    AdminFlash, AdminDialog, AdminDialogForm, AdminForm, AdminFilters, AdminPagination, AdminToolbar, AdminGrid
  },
  provide() {
    return {
      context: this.admin.context,
      dispatcher: this.admin.dispatcher,
    }
  },
  props: {
    admin: {
      type: Admin,
      required: true
    }
  },

}
</script>

<style lang="scss">
.crud-grid {

  .v-data-table {
    margin-left: 56px;
  }

  .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }
}
</style>
