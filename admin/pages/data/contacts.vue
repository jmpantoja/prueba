<template>
  <atn-admin :admin="admin"/>
</template>

<script>

import AtnAdmin from "../../plugins/atn/components/AtnAdmin";

export default {
  components: {AtnAdmin},
  data() {

    return {
      admin: this.$adminManager.byName('contacts')
    }
  }
}
</script>
