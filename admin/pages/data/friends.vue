<template>
  <admin-crud :admin="admin"/>
</template>

<script>
import AdminCrud from "~/plugins/admin/components/admin/AdminCrud.vue";
import ContactAdmin from "~/src/admin/ContactAdmin";

export default {
  components: {AdminCrud},
  inject: ['locale'],

  data() {
    return {
      admin: new ContactAdmin({
        locale: this.locale,
        axios: this.$axios
      }),
    }
  }
}
</script>
