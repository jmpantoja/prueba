<template>
  <contact-grid :grid="grid"/>
</template>

<script lang="ts">
import {defineComponent, useContext} from "@nuxtjs/composition-api";
import ContactAdmin from "~/src/admin/ContactAdmin";
import ContactGrid from "~/components/contact/ContactGrid.vue";

export default defineComponent({
  name: "ContactCrud",
  components: {ContactGrid},
  setup() {

    const {$adminStack} = useContext()
    const  admin = $adminStack.byName('contact')

    return {
      grid: admin.grid
    }
  }
})
</script>

