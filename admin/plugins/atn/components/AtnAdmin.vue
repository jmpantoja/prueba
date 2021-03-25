<template>
  <div>
    <atn-admin-form :form="admin.form"/>
    <atn-admin-dialog :dialog="admin.dialog"/>
    <atn-admin-flash :flash="admin.flash"/>
    <atn-admin-toolbar :toolbar="admin.toolbar"/>
    <v-card class="admin-grid elevation-3 ma-3 overflow-hidden">
      <v-card-text>
        <atn-admin-filters :grid="admin.grid"/>
        <atn-admin-grid :grid="admin.grid"/>
      </v-card-text>

      <v-card-actions>
        <atn-admin-pagination :grid="admin.grid"/>
      </v-card-actions>
    </v-card>

  </div>
</template>

<script>
import {Admin} from "../src";
import AtnAdminPagination from "./AtnAdminPagination";
import AtnAdminFilters from "./AtnAdminFilters";
import AtnAdminForm from "./AtnAdminForm";
import AtnAdminDialog from "./AtnAdminDialog";
import AtnAdminFlash from "./AtnAdminFlash";

export default {
  name: "AtnAdmin",
  components: {AtnAdminFlash, AtnAdminDialog, AtnAdminForm, AtnAdminFilters, AtnAdminPagination},
  provide() {
    return {
      trans: (key) => {
        return this.admin.i18n.translate(key)
      },
      manager: this.admin.actionManager
    }
  },
  props: {
    admin: {
      type: Admin,
      required: true
    }
  }
}
</script>

<style scoped lang="scss">

.admin-grid {
  .v-data-table {
    margin-left: 56px;
    //margin-left: 41px;
  }
}

</style>
