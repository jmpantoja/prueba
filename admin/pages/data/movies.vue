<template>
  <atn-admin :admin="admin"/>
</template>

<script>

import AtnAdmin from "../../plugins/atn/components/admin/AtnAdmin";

export default {
  components: {AtnAdmin},
  data() {
    return {
      admin: this.$adminManager.byName('movies')
    }
  }
}
</script>
